<?php if(!isset($connection)) die('<title>Access Denied</title><i>This page cannot be accessed directly</i>'); ?>
<?php $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? protect(strtolower($_SERVER['HTTP_USER_AGENT'])) : 'Mozilla/5.0 (Windows NT 6.1; rv:54.0) Gecko/20100101 Firefox/54.0'; ?> 
<h2><?php echo $lang[275] ?> : </h2> <!--<?php echo Get_Domain(siteurl) ?> -->
<?php echo $lang[273] ?> : 
<a href ="<?php echo siteurl ?>/?profile"><?php echo siteurl ?>/?profile</a>

 
 <h2><span class="icon-file-code"></span> 1. <?php echo $lang[286] ?> : </h2> <ul>
 
 <li><h4><?php echo $lang[274] ?> : </h4></li>
<div class="table-responsive top20 <?php echo ClassAnimated ?> swing">
<table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $lang[255] ?></th>
        <th><?php echo $lang[277] ?></th>
        <th><?php echo $lang[132] ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>uploadfile</td>
        <td><?php echo IntToIcon('1') ?></td>
        <td><?php echo $lang[36] ?></td>
      </tr>
      <tr>
        <td>passwordfile</td>
        <td><?php echo IntToIcon('1') ?></td>
        <td><?php echo $lang[37] ?></td>
      </tr>
      <tr>
        <td>ispublic</td>
        <td><?php echo IntToIcon('1') ?></td>
        <td><?php echo $lang[176] ?></td>
      </tr>
	   <tr>
        <td>api</td>
        <td><?php echo IntToIcon('0') ?></td>
        <td><?php echo $lang[275] ?></td>
      </tr>
	   <tr>
        <td>username</td>
        <td><?php echo IntToIcon('0') ?></td>
        <td><?php echo $lang[35] ?></td>
      </tr>
    </tbody>
  </table>
 </div>

 <li><h4><?php echo $lang[285] ?> : </h4></li>
<!-- HTML generated using hilite.me -->
<pre dir="ltr" style="margin: 0; line-height: 125% ;"> <span style="color: #204a87; font-weight: bold">var</span>
  <span style="color: #000000">Form1</span><span style="color: #ce5c00; font-weight: bold">:</span> <span style="color: #000000">TForm1</span><span style="color: #ce5c00; font-weight: bold">;</span>
  <span style="color: #000000">BaseUrl</span> <span style="color: #ce5c00; font-weight: bold">,</span> <span style="color: #000000">userName</span> <span style="color: #ce5c00; font-weight: bold">,</span> <span style="color: #000000">apikey</span>  <span style="color: #ce5c00; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">string</span> <span style="color: #ce5c00; font-weight: bold">;</span>

<span style="color: #204a87; font-weight: bold">implementation</span>

<span style="color: #8f5902; font-style: italic">{$R *.dfm}</span>
 <span style="color: #204a87; font-weight: bold">function</span> <span style="color: #000000">UploadFile</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">Sfile</span><span style="color: #ce5c00; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">string</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">string</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #8f5902; font-style: italic">{</span>
<span style="color: #8f5902; font-style: italic">const</span>
<span style="color: #8f5902; font-style: italic">BaseUrl =&#39;<?php echo defined('siteurl') ? siteurl :'http://127.0.0.1/AjaxUploader' ?>&#39;;</span>
<span style="color: #8f5902; font-style: italic">userName = &#39;<?php echo defined('UserName') ? UserName : 'UserName' ?>&#39; ;</span>
<span style="color: #8f5902; font-style: italic">apikey = &#39;<?php echo defined('UserEmail') ? clean(Encrypt(TwoWayEncrypt(UserEmail,RegisterDate))) : 'cHFcHhYd3R2eX07cXZ7' ?>&#39;  ;   }</span>
<span style="color: #204a87; font-weight: bold">var</span>
    <span style="color: #000000">Params</span><span style="color: #ce5c00; font-weight: bold">:</span> <span style="color: #000000">TIdMultipartFormDataStream</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #204a87; font-weight: bold">begin</span>
<span style="color: #000000">BaseUrl</span> <span style="color: #ce5c00; font-weight: bold">:=</span> <span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Edit1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Text</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">userName</span> <span style="color: #ce5c00; font-weight: bold">:=</span> <span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Edit2</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Text</span> <span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">apikey</span> <span style="color: #ce5c00; font-weight: bold">:=</span> <span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Edit3</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Text</span>  <span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Cursor</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #000000">crHourGlass</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Label1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Caption</span> <span style="color: #ce5c00; font-weight: bold">:=</span> <span style="color: #4e9a06">&#39;&#39;</span><span style="color: #ce5c00; font-weight: bold">;</span>

<span style="color: #204a87; font-weight: bold">try</span>
<span style="color: #000000">Params</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #000000">TIdMultiPartFormDataStream</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Create</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">Params</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">AddFile</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #4e9a06">&#39;uploadfile&#39;</span><span style="color: #ce5c00; font-weight: bold">,</span><span style="color: #204a87; font-weight: bold">pchar</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">Sfile</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">,</span><span style="color: #4e9a06">&#39;multipart/form-data&#39;</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">Params</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">AddFormField</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #4e9a06">&#39;passwordfile&#39;</span><span style="color: #ce5c00; font-weight: bold">,</span><span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Edit4</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Text</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">Params</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">AddFormField</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #4e9a06">&#39;ispublic&#39;</span><span style="color: #ce5c00; font-weight: bold">,</span><span style="color: #204a87">IntToStr</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #204a87; font-weight: bold">Integer</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">CheckBox1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Checked</span><span style="color: #000000; font-weight: bold">)))</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">IdHTTP1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Request</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">CustomHeaders</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Clear</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">IdHTTP1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Request</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">UserAgent</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #4e9a06">&#39;<?php echo $userAgent ?>&#39;</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">IdHTTP1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Request</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">CustomHeaders</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Add</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #4e9a06">&#39;X-Requested-With: XMLHttpRequest&#39;</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">;</span>


<span style="color: #204a87; font-weight: bold">try</span>
<span style="color: #3465a4">result</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Idhttp1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">post</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">BaseUrl</span><span style="color: #ce5c00; font-weight: bold">+</span><span style="color: #4e9a06">&#39;/ajax/index.php?uploadfile&amp;api=&#39;</span><span style="color: #ce5c00; font-weight: bold">+</span><span style="color: #000000">apikey</span><span style="color: #ce5c00; font-weight: bold">+</span><span style="color: #4e9a06">&#39;=&amp;username=&#39;</span><span style="color: #ce5c00; font-weight: bold">+</span><span style="color: #000000">userName</span><span style="color: #ce5c00; font-weight: bold">,</span><span style="color: #000000">Params</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #204a87; font-weight: bold">except</span>
 <span style="color: #3465a4">result</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #4e9a06">&#39;{&quot;success&quot;:false,&quot;msg&quot;:&quot;Server not responding&quot;}&#39;</span><span style="color: #ce5c00; font-weight: bold">;</span>
 <span style="color: #8f5902; font-style: italic">//on E : Exception do ShowMessage(E.ClassName+&#39; error raised, with message : &#39;+E.Message);</span>
<span style="color: #204a87; font-weight: bold">end</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #204a87; font-weight: bold">Finally</span>
  <span style="color: #000000">Params</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Free</span>  <span style="color: #ce5c00; font-weight: bold">;</span>
  <span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Cursor</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #000000">crDefault</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #204a87; font-weight: bold">end</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #204a87; font-weight: bold">end</span><span style="color: #ce5c00; font-weight: bold">;</span>
</pre>

<li><h4><?php echo $lang[287] ?> : </h4></li>
<!-- HTML generated using hilite.me -->
<pre dir="ltr"  style="margin: 0; line-height: 125%"><span style="color: #000000">&lt;meta charset=&quot;UTF-8&quot;&gt; </span>
<span style="color: #000000">&lt;form  method=&quot;post&quot; enctype=&quot;multipart/form-data&quot;&gt;</span>
<span style="color: #000000">        &lt;input type=&quot;file&quot; name=&quot;uploadfile&quot;&gt;</span>
<span style="color: #000000">		&lt;input type=&quot;password&quot; name=&quot;passwordfile&quot;&gt;</span>
<span style="color: #000000">		&lt;input type=&quot;checkbox&quot; name=&quot;ispublic&quot; value=&quot;1&quot; checked&gt; is public </span>
<span style="color: #000000">        &lt;input type=&quot;submit&quot; name=&quot;&quot;&gt;</span>
<span style="color: #000000">&lt;/form&gt;</span>
<span style="color: #000000">&lt;hr&gt;</span>
<span style="color: #8f5902; font-style: italic">&lt;?php</span> 
<span style="color: #000000">$BaseUrl</span> <span style="color: #ce5c00; font-weight: bold">=</span><span style="color: #4e9a06">&#39;<?php echo defined('siteurl') ? siteurl :'http://127.0.0.1/AjaxUploader' ?>&#39;</span><span style="color: #000000; font-weight: bold">;</span>
<span style="color: #000000">$userName</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #4e9a06">&#39;<?php echo defined('UserName') ? UserName : 'UserName' ?>&#39;</span> <span style="color: #000000; font-weight: bold">;</span>
<span style="color: #000000">$apikey</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #4e9a06">&#39;<?php echo defined('UserEmail') ? clean(Encrypt(TwoWayEncrypt(UserEmail,RegisterDate))) : 'cHFcHhYd3R2eX07cXZ7' ?>&#39;</span>  <span style="color: #000000; font-weight: bold">;</span> 

<span style="color: #204a87; font-weight: bold">if</span><span style="color: #000000; font-weight: bold">(</span> <span style="color: #000000">$_SERVER</span><span style="color: #000000; font-weight: bold">[</span><span style="color: #4e9a06">&#39;REQUEST_METHOD&#39;</span><span style="color: #000000; font-weight: bold">]</span> <span style="color: #ce5c00; font-weight: bold">==</span> <span style="color: #4e9a06">&#39;POST&#39;</span> <span style="color: #000000; font-weight: bold">){</span>

        <span style="color: #000000">$files</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #000000">$_FILES</span><span style="color: #000000; font-weight: bold">[</span><span style="color: #4e9a06">&#39;uploadfile&#39;</span><span style="color: #000000; font-weight: bold">];</span>
		<span style="color: #000000">$passwordfile</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #000000">$_POST</span><span style="color: #000000; font-weight: bold">[</span><span style="color: #4e9a06">&#39;passwordfile&#39;</span><span style="color: #000000; font-weight: bold">];</span>
		<span style="color: #000000">$ispublic</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #000000; font-weight: bold">(</span><span style="color: #204a87">isset</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$_POST</span><span style="color: #000000; font-weight: bold">[</span><span style="color: #4e9a06">&#39;ispublic&#39;</span><span style="color: #000000; font-weight: bold">]))</span> <span style="color: #ce5c00; font-weight: bold">?</span> <span style="color: #4e9a06">&#39;1&#39;</span> <span style="color: #ce5c00; font-weight: bold">:</span> <span style="color: #4e9a06">&#39;0&#39;</span><span style="color: #000000; font-weight: bold">;</span>

 <span style="color: #000000">$post</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #204a87; font-weight: bold">array</span><span style="color: #000000; font-weight: bold">(</span>
    <span style="color: #4e9a06">&#39;uploadfile&#39;</span><span style="color: #ce5c00; font-weight: bold">=&gt;</span> <span style="color: #4e9a06">&#39;@&#39;</span><span style="color: #ce5c00; font-weight: bold">.</span> <span style="color: #000000">$_FILES</span><span style="color: #000000; font-weight: bold">[</span><span style="color: #4e9a06">&#39;uploadfile&#39;</span><span style="color: #000000; font-weight: bold">][</span><span style="color: #4e9a06">&#39;tmp_name&#39;</span><span style="color: #000000; font-weight: bold">]</span><span style="color: #ce5c00; font-weight: bold">.</span> <span style="color: #4e9a06">&#39;;filename=&#39;</span> <span style="color: #ce5c00; font-weight: bold">.</span> <span style="color: #000000">$_FILES</span><span style="color: #000000; font-weight: bold">[</span><span style="color: #4e9a06">&#39;uploadfile&#39;</span><span style="color: #000000; font-weight: bold">][</span><span style="color: #4e9a06">&#39;name&#39;</span><span style="color: #000000; font-weight: bold">]</span> <span style="color: #000000; font-weight: bold">,</span>
    <span style="color: #4e9a06">&#39;ispublic&#39;</span> <span style="color: #ce5c00; font-weight: bold">=&gt;</span> <span style="color: #000000">$ispublic</span><span style="color: #000000; font-weight: bold">,</span>
    <span style="color: #4e9a06">&#39;passwordfile&#39;</span> <span style="color: #ce5c00; font-weight: bold">=&gt;</span> <span style="color: #000000">$passwordfile</span>
<span style="color: #000000; font-weight: bold">);</span>   
	
<span style="color: #000000">$ch</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #204a87">curl_init</span><span style="color: #000000; font-weight: bold">();</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_URL</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">$BaseUrl</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #4e9a06">&#39;/ajax/index.php?uploadfile&amp;api=&#39;</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">$apikey</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #4e9a06">&#39;=&amp;username=&#39;</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">$userName</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_HEADER</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #0000cf; font-weight: bold">0</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_VERBOSE</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #0000cf; font-weight: bold">0</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_FOLLOWLOCATION</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #204a87; font-weight: bold">true</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_RETURNTRANSFER</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #204a87; font-weight: bold">true</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_USERAGENT</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">$_SERVER</span><span style="color: #000000; font-weight: bold">[</span><span style="color: #4e9a06">&#39;HTTP_USER_AGENT&#39;</span><span style="color: #000000; font-weight: bold">]);</span>
<span style="color: #8f5902; font-style: italic">//curl_setopt($ch, CURLOPT_HTTPHEADER, array(&quot;X-Requested-With: XMLHttpRequest&quot;, &quot;Content-Type: application/json; charset=utf-8&quot;));</span>

<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_POST</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #204a87; font-weight: bold">true</span><span style="color: #000000; font-weight: bold">);</span>

<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_POSTFIELDS</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">$post</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #000000">$response</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #204a87">curl_exec</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_close</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">);</span>

<span style="color: #8f5902; font-style: italic">//echo $response;</span>

<span style="color: #204a87; font-weight: bold">echo</span> <span style="color: #4e9a06">&#39;&lt;pre&gt;&#39;</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #204a87">json_encode</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #204a87">json_decode</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$response</span><span style="color: #000000; font-weight: bold">),</span> <span style="color: #000000">JSON_PRETTY_PRINT</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #4e9a06">&#39;&lt;/pre&gt;&#39;</span><span style="color: #000000; font-weight: bold">;</span>	

<span style="color: #8f5902; font-style: italic">/*$response = json_decode($response, true);</span>
<span style="color: #8f5902; font-style: italic">if($response[&#39;success&#39;] == &#39;true&#39;)</span>
<span style="color: #8f5902; font-style: italic">	echo &#39;&lt;a href =&quot;&#39;.$BaseUrl.&#39;/?download=&#39;.$response[&#39;cryptID&#39;].&#39;&quot;&gt;&#39;.$response[&#39;originalFilename&#39;].&#39;&lt;/a&gt;&#39;;*/</span>
<span style="color: #000000; font-weight: bold">}</span>
	
<span style="color: #8f5902; font-style: italic">?&gt;</span><span style="color: #000000"></span>
</pre>


</ul>

<h2><span class="icon-doc-text"></span> <?php echo $lang[276] ?> : </h2><ul>
 
 <li class="text-success"><h4 ><?php echo $lang[16] ?> : </h4></li>
<!-- HTML generated using hilite.me -->
<pre dir="ltr" style="margin: 0; line-height: 125%"><span style="color: #000000; font-weight: bold">{</span>
   <span style="color: #204a87; font-weight: bold">&quot;success&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">true</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;FileName&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;file_2018-08-11_081735.jpg&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;originalFilename&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;sample.jpg&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;Icon&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;icon-file-image&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;Size&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #0000cf; font-weight: bold">7324</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;SavedFile&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;..\/uploads\/file_2018-08-11_081735.jpg&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;Extension&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;jpg&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;DeleteId&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;kQ8fQjVW6a&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;DownloadId&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;uz2y1v0L8a&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;ID&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #0000cf; font-weight: bold">854</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;cryptID&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;ODU0&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;UploadDir&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;\/uploads&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;ThumbnailDir&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;\/uploads\/_thumbnail\/d7e1d8ec7eb1928ec9d4aa537ee2600e.jpg&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;IsLogin&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">false</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;footerInfo&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;Copyright © 2018. All rights reserved ( onexite ).&quot;</span>
<span style="color: #000000; font-weight: bold">}</span>
</pre>
</ul>

<!-- <h2><?php echo $lang[17] ?> : </h2> --><ul>
<!-- HTML generated using hilite.me -->
<li class="text-danger"><h4><?php echo $lang[279] ?> : </h4></li>
<pre dir="ltr" style="margin: 0; line-height: 125%"><span style="color: #000000; font-weight: bold">{</span>
   <span style="color: #204a87; font-weight: bold">&quot;success&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">false</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;msg&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;Access to API is disabled&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;footerInfo&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;Copyright © 2018. All rights reserved ( onexite ).&quot;</span>
<span style="color: #000000; font-weight: bold">}</span>
</pre>

<li class="text-danger"><h4><?php echo str_replace(".","",$lang[120]); ?> : </h4></li>
<!-- HTML generated using hilite.me -->
<pre dir="ltr" style="margin: 0; line-height: 125%"><span style="color: #000000; font-weight: bold">{</span>
   <span style="color: #204a87; font-weight: bold">&quot;success&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">false</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;msg&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;Invalid file type&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;footerInfo&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;Copyright © 2018. All rights reserved ( onexite ).&quot;</span>
<span style="color: #000000; font-weight: bold">}</span>
</pre>

</ul>

<h2><span class="icon-file-code"></span> 2. <?php echo $lang[8] ?> : </h2><ul>
<li><h4><?php echo $lang[274] ?> : </h4></li>
<div class="table-responsive top20 <?php echo ClassAnimated ?> swing">
<table class="table table-bordered">
    <thead>
      <tr>
        <th><?php echo $lang[255] ?></th>
        <th><?php echo $lang[277] ?></th>
        <th><?php echo $lang[132] ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>files</td>
        <td><?php echo IntToIcon('1') ?></td>
        <td><?php echo '/' ?></td>
      </tr>
      <tr>
        <td>json</td>
        <td><?php echo IntToIcon('1') ?></td>
        <td><?php echo '/' ?></td>
      </tr>
      <tr>
        <td>currentpage</td>
        <td><?php echo IntToIcon('0') ?></td>
        <td><?php echo $lang[190] ?></td>
      </tr>
	   <tr>
        <td>api</td>
        <td><?php echo IntToIcon('1') ?></td>
        <td><?php echo $lang[275] ?></td>
      </tr>
	   <tr>
        <td>username</td>
        <td><?php echo IntToIcon('1') ?></td>
        <td><?php echo $lang[35] ?></td>
      </tr>
    </tbody>
  </table>
 </div>
 
  <li><h4><?php echo $lang[285] ?> : </h4></li>
<!-- HTML generated using hilite.me -->
<pre dir="ltr" style="margin: 0; line-height: 125%"><span style="color: #204a87; font-weight: bold">var</span>
  <span style="color: #000000">Form1</span><span style="color: #ce5c00; font-weight: bold">:</span> <span style="color: #000000">TForm1</span><span style="color: #ce5c00; font-weight: bold">;</span>
  <span style="color: #000000">BaseUrl</span> <span style="color: #ce5c00; font-weight: bold">,</span> <span style="color: #000000">userName</span> <span style="color: #ce5c00; font-weight: bold">,</span> <span style="color: #000000">apikey</span>  <span style="color: #ce5c00; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">string</span> <span style="color: #ce5c00; font-weight: bold">;</span>

<span style="color: #204a87; font-weight: bold">implementation</span>

<span style="color: #8f5902; font-style: italic">{$R *.dfm}</span>
   <span style="color: #204a87; font-weight: bold">function</span> <span style="color: #000000">ListFiles</span><span style="color: #000000; font-weight: bold">()</span><span style="color: #ce5c00; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">string</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #8f5902; font-style: italic">{</span>
<span style="color: #8f5902; font-style: italic">const</span>
<span style="color: #8f5902; font-style: italic">BaseUrl =&#39;<?php echo defined('siteurl') ? siteurl :'http://127.0.0.1/AjaxUploader' ?>&#39;;</span>
<span style="color: #8f5902; font-style: italic">userName = &#39;<?php echo defined('UserName') ? UserName : 'UserName' ?>&#39; ;</span>
<span style="color: #8f5902; font-style: italic">apikey = &#39;<?php echo defined('UserEmail') ? clean(Encrypt(TwoWayEncrypt(UserEmail,RegisterDate))) : 'cHFcHhYd3R2eX07cXZ7' ?>&#39;  ;   }</span>

<span style="color: #204a87; font-weight: bold">begin</span>
<span style="color: #000000">BaseUrl</span> <span style="color: #ce5c00; font-weight: bold">:=</span> <span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Edit1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Text</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">userName</span> <span style="color: #ce5c00; font-weight: bold">:=</span> <span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Edit2</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Text</span> <span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">apikey</span> <span style="color: #ce5c00; font-weight: bold">:=</span> <span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Edit3</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Text</span>  <span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Cursor</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #000000">crHourGlass</span><span style="color: #ce5c00; font-weight: bold">;</span>

<span style="color: #204a87; font-weight: bold">try</span>

<span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">IdHTTP1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Request</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">CustomHeaders</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Clear</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">IdHTTP1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Request</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">UserAgent</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #4e9a06">&#39;<?php echo $userAgent ?>&#39;</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">IdHTTP1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Request</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">CustomHeaders</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Add</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #4e9a06">&#39;X-Requested-With: XMLHttpRequest&#39;</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">;</span>


<span style="color: #204a87; font-weight: bold">try</span>
<span style="color: #3465a4">result</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Idhttp1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">get</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">BaseUrl</span><span style="color: #ce5c00; font-weight: bold">+</span><span style="color: #4e9a06">&#39;/ajax/index.php?files&amp;json&amp;&amp;currentpage=1&amp;api=&#39;</span><span style="color: #ce5c00; font-weight: bold">+</span><span style="color: #000000">apikey</span><span style="color: #ce5c00; font-weight: bold">+</span><span style="color: #4e9a06">&#39;=&amp;username=&#39;</span><span style="color: #ce5c00; font-weight: bold">+</span><span style="color: #000000">userName</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #204a87; font-weight: bold">except</span>
 <span style="color: #3465a4">result</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #4e9a06">&#39;{&quot;success&quot;:false,&quot;msg&quot;:&quot;Server not responding&quot;}&#39;</span><span style="color: #ce5c00; font-weight: bold">;</span>
 <span style="color: #8f5902; font-style: italic">//on E : Exception do ShowMessage(E.ClassName+&#39; error raised, with message : &#39;+E.Message);</span>
<span style="color: #204a87; font-weight: bold">end</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #204a87; font-weight: bold">Finally</span>
  <span style="color: #000000">form1</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">Cursor</span><span style="color: #ce5c00; font-weight: bold">:=</span><span style="color: #000000">crDefault</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #204a87; font-weight: bold">end</span><span style="color: #ce5c00; font-weight: bold">;</span>
<span style="color: #204a87; font-weight: bold">end</span><span style="color: #ce5c00; font-weight: bold">;</span>
</pre>

<li><h4><?php echo $lang[287] ?> : </h4></li>
<!-- HTML generated using hilite.me -->
<pre dir="ltr" style="margin: 0; line-height: 125%"><span style="color: #000000">&lt;meta charset=&quot;UTF-8&quot;&gt; </span>
<span style="color: #8f5902; font-style: italic">&lt;?php</span> 
<span style="color: #000000">$BaseUrl</span> <span style="color: #ce5c00; font-weight: bold">=</span><span style="color: #4e9a06">&#39;<?php echo defined('siteurl') ? siteurl :'http://127.0.0.1/AjaxUploader' ?>&#39;</span><span style="color: #000000; font-weight: bold">;</span>
<span style="color: #000000">$userName</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #4e9a06">&#39;<?php echo defined('UserName') ? UserName : 'UserName' ?>&#39;</span> <span style="color: #000000; font-weight: bold">;</span>
<span style="color: #000000">$apikey</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #4e9a06">&#39;<?php echo defined('UserEmail') ? clean(Encrypt(TwoWayEncrypt(UserEmail,RegisterDate))) : 'cHFcHhYd3R2eX07cXZ7' ?>&#39;</span>  <span style="color: #000000; font-weight: bold">;</span> 

<span style="color: #000000">$ch</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #204a87">curl_init</span><span style="color: #000000; font-weight: bold">();</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_URL</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">$BaseUrl</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #4e9a06">&#39;/ajax/index.php?files&amp;json&amp;currentpage=1&amp;api=&#39;</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">$apikey</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #4e9a06">&#39;=&amp;username=&#39;</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #000000">$userName</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_HEADER</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #0000cf; font-weight: bold">0</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_VERBOSE</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #0000cf; font-weight: bold">0</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_FOLLOWLOCATION</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #204a87; font-weight: bold">true</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_RETURNTRANSFER</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #204a87; font-weight: bold">true</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_USERAGENT</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">$_SERVER</span><span style="color: #000000; font-weight: bold">[</span><span style="color: #4e9a06">&#39;HTTP_USER_AGENT&#39;</span><span style="color: #000000; font-weight: bold">]);</span>

<span style="color: #204a87">curl_setopt</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #000000">CURLOPT_POST</span><span style="color: #000000; font-weight: bold">,</span> <span style="color: #204a87; font-weight: bold">false</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #000000">$response</span> <span style="color: #ce5c00; font-weight: bold">=</span> <span style="color: #204a87">curl_exec</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">);</span>
<span style="color: #204a87">curl_close</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$ch</span><span style="color: #000000; font-weight: bold">);</span>

<span style="color: #8f5902; font-style: italic">//echo $response;</span>

<span style="color: #204a87; font-weight: bold">echo</span> <span style="color: #4e9a06">&#39;&lt;pre&gt;&#39;</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #204a87">json_encode</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #204a87">json_decode</span><span style="color: #000000; font-weight: bold">(</span><span style="color: #000000">$response</span><span style="color: #000000; font-weight: bold">),</span> <span style="color: #000000">JSON_PRETTY_PRINT</span><span style="color: #000000; font-weight: bold">)</span><span style="color: #ce5c00; font-weight: bold">.</span><span style="color: #4e9a06">&#39;&lt;/pre&gt;&#39;</span><span style="color: #000000; font-weight: bold">;</span>	
	
<span style="color: #8f5902; font-style: italic">?&gt;</span><span style="color: #000000"></span>
</pre>
</ul>
<h2><span class="icon-doc-text"></span> <?php echo $lang[276] ?> : </h2><ul>
 
 <li class="text-success"><h4 ><?php echo $lang[50] ?> : </h4></li>
<!-- HTML generated using hilite.me -->
<pre dir="ltr" style="margin: 0; line-height: 125%"><span style="color: #000000; font-weight: bold">{</span>
   <span style="color: #204a87; font-weight: bold">&quot;success_msg&quot;</span><span style="color: #000000; font-weight: bold">:[</span>
      <span style="color: #000000; font-weight: bold">{</span>
         <span style="color: #204a87; font-weight: bold">&quot;public&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;1&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;fileid&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;304&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;date&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;2 weeks ago&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;size&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;19,31 MB&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;folder&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;\/uploads&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;filename&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;file_2018-08-03_164710.3gp&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;orgfilename&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;Athmane Bali - Kef Non Live.3gp&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;downurl&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;\/?download=MzA0&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;downtotal&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;0&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;comments&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;0&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;deletehash&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;&#39;98fvzpZNZk&#39;&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;accesspass&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;0&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;cryptid&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;MzA0&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;thumbnaildir&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;&quot;</span>
      <span style="color: #000000; font-weight: bold">},</span>
      <span style="color: #000000; font-weight: bold">{</span>
         <span style="color: #204a87; font-weight: bold">&quot;public&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;1&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;fileid&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;301&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;date&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;3 weeks ago&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;size&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;26,17 KB&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;folder&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;\/uploads&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;filename&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;file_2018-07-30_181347.png&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;orgfilename&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;index.png&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;downurl&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;\/?download=MzAx&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;downtotal&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;1&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;comments&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;0&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;deletehash&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;&#39;LRSIkxVadM&#39;&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;accesspass&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;0&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;cryptid&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;MzAx&quot;</span><span style="color: #000000; font-weight: bold">,</span>
         <span style="color: #204a87; font-weight: bold">&quot;thumbnaildir&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;\/uploads\/_thumbnail\/6c4507d627fd5adce23607b6fa168c2a.png&quot;</span>
      <span style="color: #000000; font-weight: bold">}</span>
   <span style="color: #000000; font-weight: bold">],</span>
   <span style="color: #204a87; font-weight: bold">&quot;success&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">true</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;totalpages&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #0000cf; font-weight: bold">4</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;currentpage&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #0000cf; font-weight: bold">1</span>
<span style="color: #000000; font-weight: bold">}</span>
</pre>
<li class="text-danger"><h4><?php echo $lang[95] ?> : </h4></li>
 
 <!-- HTML generated using hilite.me -->
<pre dir="ltr" style="margin: 0; line-height: 125%"><span style="color: #000000; font-weight: bold">{</span>
   <span style="color: #204a87; font-weight: bold">&quot;success&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #204a87; font-weight: bold">false</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;msg&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;You must login first&quot;</span><span style="color: #000000; font-weight: bold">,</span>
   <span style="color: #204a87; font-weight: bold">&quot;footerInfo&quot;</span><span style="color: #000000; font-weight: bold">:</span><span style="color: #4e9a06">&quot;Copyright © 2018. All rights reserved ( onexite ).&quot;</span>
<span style="color: #000000; font-weight: bold">}</span>

</pre></ul>

<br>