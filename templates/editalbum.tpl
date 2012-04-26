<div id="main">
	<div id="content">
    	<div align="center"><h1>Edit Album</h1></div>
        <form action="commit/commitalbum.php?action=edit" method="post" id="editalbum">
        	<fieldset>
            	<legend>Album Details</legend>
                <ol>
                	<li><label for="name">Album Name</label><input type="text" name="name" value="{$album.album_name}" /></li>
                    <li>
                    	<label for="other">Other Details</label>
                        <strong>Created on</strong>: {$album.date|date_format}
                        <strong>by</strong> {$album.username}
                        <strong>Type</strong>: {$album.type_name}
                    </li>
                    <li>Archive this album<input type="checkbox" name="arc" {if $album.arc == 1}checked="checked"{/if}/></li>
                </ol>
            </fieldset>
        	
            {foreach name=pics from=$pictures item=pic}
            <fieldset>
            	<ol>
                    <li>
                    	<label for="pic{$pic.id}">Caption:<textarea style="vertical-align:middle;margin-left:5px" name="cap{$pic.id}" rows="7" cols="23">{$pic.comment}</textarea></label>
                        <a href="{$pic.path}" title="{$pic.comment}" class="thickbox"><img src="{$pic.thumb}" alt="Click for a full view" title="Click for a full view" align="right" /></a>
                       
                    </li>
                    <li class="ac">
                    	<div class="left" style="text-align:left">
                        	In this photo: <input type="text" id="tag{$pic.id}" />
                            				<br/>
                            <ul id="list{$pic.id}">
                            {foreach from=$pic.tags item=tag}
                            	<li id="{$tag.id}">{$tag.name} <a href="#" class="removeable" id="{$tag.id}">[remove]</a></li>
                            {/foreach}
                            </ul>
                        </div>
                    	<div class="right" style="text-align:right">
                        	<input type="radio" name="cover" value="{$pic.id}" {if $pic.id == $album.cover}checked="checked"{/if}/> Cover photo<br/>
                        	<input type="checkbox" name="feat{$pic.id}" {if $pic.featured == 1}checked="checked"{/if}/> Featured photo<br/>
                        	<input type="checkbox" name="del{$pic.id}"/> Delete this photo
                            <input type="hidden" name="hidden_tag{$pic.id}" id="hidden_tag{$pic.id}"/>
                        </div>
                    </li>
                    {if $smarty.foreach.pics.last}
                    <li>
                    	<input type="submit" value="Save Changes"/>
                    </li>
            		{/if}
            	</ol>
            </fieldset>
            {foreachelse}
            <p>There are no pictures in this album</p>
            {/foreach}
            <input type="hidden" name="pic_ids" id="pic_ids" value="{$pic_ids}"/>
            <input type="hidden" name="id" value="{$album.album_id}"/>
        </form>
    </div>