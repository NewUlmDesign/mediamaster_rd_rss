(function($){$.fn.wpRssMediamaster=function(opt){var def={FeedUrl:FeedUrl,MaxCount:MaxCount,ShowDesc:true,ShowPubDate:showDate};if(opt){$.extend(def,opt)}var idd=$(this).attr('id');if(def.FeedUrl==null||def.FeedUrl==''){$('#'+idd).empty();return}var pubdt;$('#'+idd).empty().append('<div style="text-align:left; padding:3px;"><img src="loader.gif" /></div>');$.ajax({url:'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num='+def.MaxCount+'&output=json&q='+encodeURIComponent(def.FeedUrl)+'&callback=?',dataType:'json',success:function(data){$('#'+idd).empty();$.each(data.responseData.feed.entries,function(i,entry){$('#'+idd).append('<div class="Titolo"><a href="'+entry.link+'" target="_blank" >'+entry.title+'</a></div>');if(def.ShowPubDate){pubdt=new Date(entry.publishedDate);$('#'+idd).append('<div class="Data">'+pubdt.toLocaleDateString()+'</div>'); $('#'+idd).append('<p class="autorepost">'+'Author: '+entry.author+'&nbsp;'+'</p>'); $('#'+idd).append('<p class="tags">'+'Tags: '+entry.categories+'&nbsp;'+'</p>')}if(def.ShowDesc)$('#'+idd).append('<div class="Contenuti">'+entry.content+'</div>')})}})}})(jQuery);