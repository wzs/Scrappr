<?php 

function strip_tags_content($text, $tags = '', $invert = FALSE) {

  preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
  $tags = array_unique($tags[1]);
    
  if(is_array($tags) AND count($tags) > 0) {
    if($invert == FALSE) {
      return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
    }
    else {
      return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
    }
  }
  elseif($invert == FALSE) {
    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
  }
  return $text;
}

function fetchEntries($format, $selector, $increase = 1, $start = 1, $limit = 0) {
	define(MAX_LIMIT, 1000);
	
	
	$entries = array();
	
	$pageId = $start;
	
    while (true) {
    	$docUrl = sprintf($format, $pageId);
    	$pq = phpQuery::newDocumentFileHTML($docUrl);
    	
    	foreach (pq($selector) as $entry)  {
    		$entries[] = trim(strip_tags_content($entry->textContent));
    	}
    	$pageId++;
    	
    	$absoluteNextPageUrl = sprintf($format, $pageId * $increase);
    	
    	$relativeNextPageUrl = explode("/", $absoluteNextPageUrl);
    	$relativeNextPageUrl = array_pop($relativeNextPageUrl);
    	
    	$nextPageElement = pq(sprintf('a[href="%s"], a[href="%s]"', $absoluteNextPageUrl, $relativeNextPageUrl));
    	
		
    	if (count($nextPageElement) == 0) {
			break;
    	}  
    	
    	if (($pageId > $limit) && ($limit != 0) )
    		break;
    }	
    return $entries;
}

?>