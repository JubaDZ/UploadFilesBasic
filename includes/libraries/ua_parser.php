<?php
/*
 *
 * 2014 - Timo Van Neerden
 * 20131110 : added IE11 detection + Windows 8.1
 * 20140404 : added Nintendo Wii/WiiU/DS/DSi/3DS
 *                  Playstation, XBox, Backberry detection
 * 20150804 : fixed Architecture detection bug (added two 64Bit-flag keywords)
 * 20160113 : added basic Symbian detection
 *
 *
 * This script is in PUBLIC DOMAIN, to what you want to with it. It’s free.
 *
 * Free PHP-User Agent Parser.
 * This script matches almost all of the "big" browsers and their mobile versions.
 * Browsers based upon these 5 browsers should work too (camino, iron, yandex, iceweasel…)
 *
 * Crowlers, and some rare browsers are not supported here, even if they might
 *  work if their UA is not too exotic
 *
 * OSes, Windows versions, Linux distros, OS-X, Nintendo 3DS versions are also detected.
 *
 * This script is not 100% complet nor 100% accurate.
 *
 *
 * The author of this script cannot be held as responsible
 *  for any damages caused by this script.
*/

$UA = '';
$infos = array();
$infos['full-UA'] = '';
$infos['browser_name'] = '';
$infos['browser_vers'] = '';
$infos['platfrm_name'] = '';
$infos['platfrm_vers'] = '';
$infos['rndreng_name'] = '';
$infos['rndreng_vers'] = '';
$infos['archtcr_name'] = 'Unknown';
$infos['misc'] = array();

$infos['ip_adress'] = $_SERVER['REMOTE_ADDR'];


if (isset($_SERVER['HTTP_USER_AGENT'])) {
	$UA = $_SERVER['HTTP_USER_AGENT'];
}

// in order to share infos with someone (on a forum, for example) an UA can be given in the URL
if (isset($_GET['ua'])) {
	$UA = hex2bin($_GET['ua']);
	$infos['ip_adress'] = $_GET['ip'];
}

$infos['full-UA'] = $UA;
$infos['full-UA-Hex'] = bin2hex($UA);


/* FIRST : BROWSER DETECTION */
/*
 * Except Opera and the very first browsers, (before Netscape), every UA
 * (at least desktop) has "mozilla" in it for compatiblity reasons.
 * 
 * So we test if Mozilla is in the UA : else it only can be Opera/presto or
 * some weird phone browsers, or the very old browsers.
 * 
 * If not Opera, we test for the old ones with the patern : "name/version ", and finaly just "name"
 *
 * We also search for the "mobile" or "mobi" keyword, and ad it next to the name.
 *
*/


// Mozilla compatible ?
if (preg_match('#^Mozilla/([0-9]{1,}\.[0-9]{1,}) #i', $UA, $matches)) {
	// at least a Mozilla browser
	$infos['browser_name'] = 'Mozilla';
	$infos['browser_vers'] = $matches[1];

	$UA_Moz = trim(str_replace($matches[0], '', $UA));

	// MSIE
	if (preg_match('#MSIE ?([0-9]{1,}\.[0-9]{1,}[a-b]?)#i', $UA_Moz, $matches_IE)) {
			$infos['browser_name'] = 'Internet-Explorer';
			$infos['browser_vers'] = $matches_IE[1];
			// version <= 7 : maybe compatibility mode !
			if (preg_match('#^[0-7]\.#', $matches_IE[1])) {
				// get Trident version
				if (preg_match('#Trident/([4-9]{1,})\.[0-9]{1,}#', $UA, $matches_trident_version)) {
					// update real version
					switch ($matches_trident_version[1]) {
						case '4': $infos['browser_vers'] = '8.0'; break;
						case '5': $infos['browser_vers'] = '9.0'; break;
						case '6': $infos['browser_vers'] = '10.0'; break;
					}
					$infos['misc'][] = 'IE '.$infos['browser_vers'].' compatibility mode IE'.$matches_IE[1];
				}
			}
	}

	/*
	 * We know that Gecko regroups them all too and that "unreal" Gecko contains *like Gecko*
	 * (Firefox &deriv) => Pure Gecko =>                contains "brwsr name" and "Gecko"
	 * (Konqueror &deriv)=> => KHTML (gecko comptbl) => contains "brwsr name", "KHTML" and "like Gecko"
	 * (Safari &deriv) => WebKit (KHTML compatbl) =>    contains "brwsr name", "Webkit", "KHTML", and "like Gecko"
	 * (Chrome &deriv) => Chrome (Safari Compatbl)      contains "brwsr name", "Safari", "Webkit", "KHTML", and "like Gecko", FTW.
	 * 
	*/

	// UA contains "gecko"
	elseif (preg_match('#gecko#i', $UA_Moz)) {
			// real Gecko, with Gecko/2012...
			if (preg_match('#gecko/([0-9]{1,}(\.?[0-9]{1,})?)#i', $UA_Moz, $m_gecko)) {
				$infos['rndreng_vers'] = $m_gecko[1];
				$infos['rndreng_name'] = 'Gecko';

				// remove "Gecko/2012..."
				$UA_Moz_Gek = trim(str_replace($m_gecko[0], '', $UA_Moz));

				// Some are based on Firefox, other than firefox
				if (preg_match('#Firefox/(([0-9]{1,}\.?){0,})?#i', $UA_Moz_Gek, $m_firefox)) {
					// at least Firefox browser
					$infos['browser_name'] = 'Firefox';
					$infos['browser_vers'] = $m_firefox[1];

					// remove "Firefox/1.5..." string
					$UA_Moz_Gek_Fox = trim(str_replace($m_firefox[0], '', $UA_Moz_Gek));

					// remove plateform infos
					$UA_Moz_Gek_Fox_Pf = trim(preg_replace('#\(.[^(]{0,}\)#U', '', $UA_Moz_Gek_Fox));
					while (preg_match('#[^()]*\((([^()]+|(?R))*)\)[^()]*#i', $UA_Moz_Gek_Fox_Pf)) {
						$UA_Moz_Gek_Fox_Pf = trim(preg_replace('#[^()]*\((([^()]+|(?R))*)\)[^()]*#iU', '', $UA_Moz_Gek_Fox_Pf));
					}

					// what remains now is like "Name/18.0" :
					if (preg_match('#([^/\s]{1,})/(([0-9]{1,}\.?){0,})#i', $UA_Moz_Gek_Fox_Pf, $m_other)) {
						$infos['browser_name'] = trim($m_other[1]);
						$infos['browser_vers'] = trim($m_other[2]);
					}
				}
				elseif (preg_match('#([^/\s]{1,})/(([0-9]{1,}\.?){0,})#i', $UA_Moz_Gek, $m_)) {
						$infos['browser_name'] = trim($m_[1]);
						$infos['browser_vers'] = trim($m_[2]);
				}
			}

			// not real Gecko. Has KHTML ? (they included "like Gecko" first) :: KHTML includes Webkit
			elseif (preg_match('#khtml#i', $UA_Moz)) {
					$UA_Moz_KlG = trim(str_replace('(KHTML, like Gecko)', '', $UA_Moz));
					// real KHTML browser
					if (preg_match('#KHTML/(([0-9]{1,}\.?){0,}) ?#i', $UA_Moz_KlG, $m_khtml)) {
						// at least some KHTML browser
						$infos['browser_name'] = 'Some-other-KHTML-browser';
						$infos['rndreng_vers'] = trim($m_khtml[1]);
						$infos['rndreng_name'] = 'KHTML';

						$UA_Moz_KlG_Kht = trim(str_replace($m_khtml[0], '', $UA_Moz_KlG));

						// Konqueror ? It's the main KHTML browser.
						if (preg_match('#Konqueror/(([0-9]{1,}\.?){0,}) ?#i', $UA_Moz_KlG, $m_konqueror)) {
							$infos['browser_name'] = 'Konqueror';
							$infos['browser_vers'] = trim($m_konqueror[1]);
						}
					}

					// not real KHTML browser, maybe webkit ?
					elseif(preg_match('#webkit#i', $UA_Moz_KlG)) {
						// Real Webkit engine
						if (preg_match('#WebKit/(([0-9]{1,}\.?){0,})#i', $UA_Moz_KlG, $m_webkit) ) {
							// at least some Webkit browser
							$infos['rndreng_name'] = 'WebKit';
							$infos['rndreng_vers'] = trim($m_webkit[1]);

							// removes "WebKit/520..."
							$UA_Moz_KlG_WKi = trim(str_replace($m_webkit[0], '', $UA_Moz_KlG));

							// is the Webkit after Apple bought it ? (those contains all "safari/version")
							if (preg_match('#safari/(([0-9]{1,}\.?){0,})#i', $UA_Moz_KlG_WKi, $m_safari)) {
								// at least we have a Safari
								$infos['browser_name'] = 'Safari';
								$infos['browser_vers'] = trim($m_safari[1]);

								// removes "Safari..."
								$UA_Moz_KlG_WKi_Saf = trim(str_replace($m_safari[0], '', $UA_Moz_KlG_WKi));

								// For Safari only : contains "Version/6.0.2" for version 6 of safari => removes because uninteresting.
								if (preg_match('#Version/(([0-9]{1,}\.?){0,})#i', $UA_Moz_KlG_WKi_Saf, $m_safari_version)) {
									$infos['browser_vers'] = trim($m_safari_version[1]);
									$UA_Moz_KlG_WKi_Saf = trim(str_replace($m_safari_version[0], '', $UA_Moz_KlG_WKi_Saf));
								}
								// For Safari Mobile : contains "Mobile/A324Eo…" => removes because uninteresting.
								if (preg_match('#Mobile/(([0-9a-zA-Z]{1,}\.?){0,})#i', $UA_Moz_KlG_WKi_Saf, $m_safari_mobile)) {
									$UA_Moz_KlG_WKi_Saf = trim(str_replace($m_safari_mobile[0], '', $UA_Moz_KlG_WKi_Saf));
								}
								// For Chrome / Safari  Mobile : remoes "Build/CVS3…"
								if (preg_match('#Build/(([0-9a-zA-Z]{1,}\.?){0,})#i', $UA_Moz_KlG_WKi_Saf, $m_safari_mobile)) {
									$UA_Moz_KlG_WKi_Saf = trim(str_replace($m_safari_mobile[0], '', $UA_Moz_KlG_WKi_Saf));
								}

								// there are many browsers on Webkit. But most of them are also based on Chrome
								if (preg_match('#Chrome/(([0-9]{1,}\.?){0,})#i', $UA_Moz_KlG_WKi_Saf, $m_chrome)) {
									// at least we have Chrome
									$infos['browser_name'] = 'Chrome';
									$infos['browser_vers'] = trim($m_chrome[1]);
									// removes "Chrome/..."
									$UA_Moz_KlG_WKi_Saf_GGC = trim(str_replace($m_chrome[0], '', $UA_Moz_KlG_WKi_Saf));
									// Something based on Chrome ?
									if (preg_match('#([^/\s]{1,})/(([0-9]{1,}\.?){0,})#i', $UA_Moz_KlG_WKi_Saf_GGC, $m_other)) {
										$infos['browser_name'] = trim($m_other[1]);
										$infos['browser_vers'] = trim($m_other[2]);

										// the next Opera will use a Chrome based Engine
										if (preg_match('#OPR/(([0-9]{1,}\.?){0,})#i', $UA_Moz_KlG_WKi_Saf_GGC, $m_opr)) {
											// at least we have Chrome
											$infos['browser_name'] = 'Opera';
											$infos['browser_vers'] = trim($m_opr[1]);

										}
									}
								}
								// not Chrome/123..., but...
								elseif (preg_match('#([^/\s]{1,})/(([0-9]{1,}\.?){0,})#i', $UA_Moz_KlG_WKi_Saf, $m_)) {
								 $infos['browser_name'] = trim($m_[1]);
								 $infos['browser_vers'] = trim($m_[2]);
								}
							}
							// not Safari/123..., but...
							elseif (preg_match('#([^/\s]{1,})/(([0-9]{1,}\.?){0,})#i', $UA_Moz_KlG_WKi, $m_)) {
							 $infos['browser_name'] = trim($m_[1]);
							 $infos['browser_vers'] = trim($m_[2]);
							}
						}
						// not Webkit/123..., but...
						elseif (preg_match('#([^/\s]{1,})/(([0-9]{1,}\.?){0,})#i', $UA_Moz_KlG, $m_)) {
						 $infos['browser_name'] = trim($m_[1]);
						 $infos['browser_vers'] = trim($m_[2]);
						}
						else {
						 // at least a Webkit Like browser
						 $infos['browser_name'] = 'Other-Webkit-LIKE-browser';
						}
					}
					// other KHTML like browser
					else {
						$infos['browser_name'] = 'Other-KHTML-LIKE-browser';
					}

			}
			// Not Gecko/123... but...
			elseif (preg_match('#([^/\s]{1,})/(([0-9]{1,}\.?){0,})#i', $UA_Moz, $m_)) {
			 $infos['browser_name'] = trim($m_[1]);
			 $infos['browser_vers'] = trim($m_[2]);
				if ($infos['browser_name'] == 'Trident') {
					$infos['browser_name'] = 'Internet-Explorer';
					preg_match('#rv:(\d*)#', $UA_Moz, $v_);
					$infos['browser_vers'] = $v_[1];
				}
			}
			else {
				$infos['browser_name'] = 'Other-gecko-like-browser';
			}
	}

	// Not "Gecko"... but...
	elseif (preg_match('#([^/\s]{1,})/(([0-9]{1,}\.?){0,})#i', $UA_Moz, $m_)) {
	 $infos['browser_name'] = trim($m_[1]);
	 $infos['browser_vers'] = trim($m_[2]);
	}
	// Old Netscape has NOT Gecko in theire shot UA string. Old NS's UA ends with ")"
	elseif (preg_match('#\)$#', $UA) ) {
	 $infos['browser_name'] = 'Netscape';
	 $infos['browser_vers'] = $matches[1];
	 $infos['misc'][] = 'One of the very firsts versions of Netscape Navigator.';
	}


// Not Mozilla : maybe Opera ?
} elseif (preg_match('#^Opera/(([0-9]{1,}\.?){0,}) #i', $UA, $matches)) {
	$infos['browser_name'] = 'Opera';
	// before Opera 10.x, version is at begining : "Opera/8.6"
	$infos['browser_vers'] = $matches[1]; // [oprv]
	// Since Opera 10.x, version is at the end of UA "Version/10.5", the begining contains only Opera/9.80 for compatibility
	if (preg_match('#Version/(([0-9]{1,}\.?){0,})#i', $UA, $opera_version)) {
		$infos['browser_vers'] = $opera_version[1];
	}
	// Presto ?
	if (preg_match('#Presto/(([0-9]{1,}\.?){0,})#i', $UA, $opera_presto_version)) {
		$infos['rndreng_name'] = 'Presto';
		$infos['rndreng_vers'] = $opera_presto_version[1];
	}

// Not Opera ? Something more exotic. Trying "^name/version".
} elseif (preg_match('#([a-z. _-]{1,})(/(([0-9]{1,}\.?){0,})?)#i', $UA, $matches)) {
	$infos['browser_name'] = $matches[1];
	$infos['browser_vers'] = $matches[3];

// not that either ? Try "name "
} elseif (preg_match('#(\w{1,}) ?#i', $UA, $matches)) {
	$infos['browser_name'] = $matches[1];

// else unknown
} else {
	$infos['browser_name'] = 'Unknown';
}

if (stripos($UA, 'Mobi')) { // mobile, mobi => for mobile browsers.
	$infos['browser_name'] = $infos['browser_name'].' Mobile';
}


/* SECONDTH : OPERATING SYSTEM DETECTION */

// OS is in perenthesis : (X11; U; SunOS sun4u; en-US; rv:1.8.1.11)
if (preg_match('#[^()]*\((([^()]+|(?R))*)\)[^()]*#i', $UA, $m_os_str)) {
	// remove ((U|N|I);) // for secured or not browser FIXME
	// remove "X11" // for linux FIXME
	// remove "compatible" strings FIXME

	// get only the OS string (the part in the parenthesis)
	$UA_Brw = trim($m_os_str[1]);


	if (preg_match('#(Linux|Win|\w{0,} ?BSD|SunOS|Solaris|Mac OS|CrOS|BeOS)#i', $UA_Brw, $m_oses)) {
		// Windows
		if (stripos($m_oses[1], 'Win') !== FALSE) {
			$infos['platfrm_name'] = 'Windows';
			if (preg_match('#NT (([0-9]{1,}\.?){0,})#i', $UA_Brw, $m_win_version)) {
				switch (substr($m_win_version[1], 0, 3) ) {
					case '4.0': $infos['platfrm_vers'] = 'NT 4.0'; break;
					case '5.0': $infos['platfrm_vers'] = '2000'; break;
					case '5.1':
					case '5.2': $infos['platfrm_vers'] = 'XP'; break;
					case '6.0': $infos['platfrm_vers'] = 'Vista'; break;
					case '6.1': $infos['platfrm_vers'] = '7'; break;
					case '6.2': $infos['platfrm_vers'] = '8'; break;
					case '6.3': $infos['platfrm_vers'] = '8.1'; break;
					default: $infos['platfrm_vers'] = $m_win_version[1]; break;
				}
			}
			elseif (preg_match('#Windows (98;|98|95|CE)#i', $UA_Brw, $m_win_version)) {
				switch ($m_win_version[1]) {
					case '98;': $infos['platfrm_vers'] = 'Millenium Edition (Me)'; break;
					default: $infos['platfrm_vers'] = $m_win_version[1]; break;
				}
			}
			elseif (preg_match('#Windows Phone O\.S (([0-9]{1,}\.?){0,})#i', $UA_Brw, $m_win_version)) {
				$infos['platfrm_name'] = 'Windows-Phone';
				$infos['platfrm_vers'] = $m_win_version[1];
			}
			elseif (preg_match('#Win(([0-9]{1,}\.?){0,})#i', $UA_Brw, $m_win_version)) {
				$infos['platfrm_vers'] = $m_win_version[1];
			}
			else {
				$infos['platfrm_vers'] = 'Uknown Version';
			}

			// XBox
			if (preg_match('#Xbox#i', $UA_Brw, $m_xbox)) {
				$infos['platfrm_name'] = 'xbox-windows';
			}


		}
		// Linux
		elseif (stripos($m_oses[1], 'Linux') !== FALSE) {
			$infos['platfrm_name'] = 'Linux';
			// try to complete with some well known distros
			if (preg_match('#(Ubuntu|Fedora|Debian|Suse|Mint|Slackware|Arch|Mandrake|Mandriva|Red ?Hat)#i', $UA_Brw, $m_linux_distro)) {
				switch (strtolower($m_linux_distro[1])) {
					case 'ubuntu': $infos['platfrm_vers'] = 'Ubuntu'; break;
					case 'fedora': $infos['platfrm_vers'] = 'Fedora'; break;
					case 'debian': $infos['platfrm_vers'] = 'Debian'; break;
					case 'suse': $infos['platfrm_vers'] = 'SuSE or Open SuSE'; break;
					case 'mint': $infos['platfrm_vers'] = 'Linux Mint'; break;
					case 'arch': $infos['platfrm_vers'] = 'Arch Linux'; break;
					case 'pclinuxos': $infos['platfrm_vers'] = 'PC Linux OS'; break;
					case 'mandrake':
					case 'mandriva': $infos['platfrm_vers'] = 'Mandriva (or Mandrake)'; break;
					case 'redhat':
					case 'red hat': $infos['platfrm_vers'] = 'Red Hat Linux'; break;
					default: $infos['platfrm_vers'] = 'Other Linux Distro'; break;
				}
			}

			elseif (preg_match('#Android ?(([0-9]{1,}\.?){0,})#i', $UA_Brw, $m_android)) {
				$infos['platfrm_name'] = 'Android';
				$infos['platfrm_vers'] = $m_android[1];
			}
		}
		// Mac OS (includes iDevices)
		elseif (stripos($m_oses[1], 'Mac OS') !== FALSE) {
			if (preg_match('#^([^;]{1,});[\w._ -;]{1,} ([0-9]{1,}([_.][0-9]){1,})#i', $UA_Brw, $m_mac_version)) {
				$infos['platfrm_name'] = $m_mac_version[1];
				$infos['platfrm_vers'] = strtr($m_mac_version[2], '_', '.');
				if (0 === strpos($infos['platfrm_name'], 'iP')) {
					$infos['platfrm_vers'] = 'iOS '.$infos['platfrm_vers'];
				}
				if (FALSE !== strpos($UA_Brw, 'OS X '.$m_mac_version[2])) {
					$infos['platfrm_vers'] = 'OS X '.$infos['platfrm_vers'];
				}

			}
		}
		else {
			$infos['platfrm_name'] =  $m_oses[1];
		}
	}

	// Android
	elseif (preg_match('#Android ?(([0-9]{1,}\.?){0,})?#i', $UA_Brw, $m_android)) {
		$infos['platfrm_name'] = 'Android';
		$infos['platfrm_vers'] = $m_android[1];
	}

	// BlackBerry
	elseif (preg_match('#(BlackBerry|BB1[0-9]+)#i', $UA_Brw, $m_blackberry)) {
		$infos['platfrm_name'] = 'BlackBerry';
		$infos['platfrm_vers'] = '';
	}

	// Nintendo DS/DSi/3DS
	elseif (preg_match('#Nintendo ?([0-9a-zA-Z]*)?#i', $UA_Brw, $m_nintendo)) {
		$infos['platfrm_name'] = 'Nintendo';
		$infos['platfrm_vers'] = $m_nintendo[1];

		// Nintendo Wii/WiiU
		if (preg_match('#WiiU?#i', $UA_Brw, $m_nintendo_wii)) {
			$infos['platfrm_name'] = 'Nintendo-Wii';
			$infos['platfrm_vers'] = $m_nintendo_wii[0];
		}
	}

	// PlayStation
	elseif (preg_match('#PLAYSTATION ([0-9]*)?#i', $UA_Brw, $m_ps)) {
		$infos['platfrm_name'] = 'PlayStation';
		$infos['platfrm_vers'] = $m_ps[1];
	}

	// Nokia/Symbian
	elseif (preg_match('#Series ?([0-9]*)?#i', $UA_Brw, $m_nokia)) {
		$infos['platfrm_name'] = 'Symbian-OS';
		$infos['platfrm_vers'] = '';
		// More precise version
		if (preg_match('#Symbian(OS)?(/([0-9.]*))?#i', $UA_Brw, $m_symbian)) {
			$infos['platfrm_name'] = 'Symbian-OS';
			$infos['platfrm_vers'] = $m_symbian[3];
		}
	}

	// Unknown OS (or not specified)
	else {
		$infos['platfrm_name'] = 'Unknown';
		$infos['platfrm_vers'] = '';
	}
}

// Unknown OS (or not specified)
else {
	$infos['platfrm_name'] = 'Unknown';
	$infos['platfrm_vers'] = '';
}


/*
 * CPU Architecture :
*/

if (preg_match('#(i\d86|x86|)#i', $UA, $m_archi)) {
	$infos['archtcr_name'] = '32 Bit';
}

if (preg_match('#(AMD64|x86_64|WOW64|Win64|x64)#i', $UA, $m_archi)) {
	$infos['archtcr_name'] = '64 Bit';
}



$GLOBALS['parsed_UA'] = $infos;
