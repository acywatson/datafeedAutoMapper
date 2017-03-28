function removeColonsFromRSS($feed) {
  // pull out colons from start tags
  // (<\w+):(\w+>)
  $pattern = '/(<\w+):(\w+>)/i'; $
  replacement = '$1$2';
  $feed = preg_replace($pattern, $replacement, $feed);
  // pull out colons from end tags
  // (<\/\w+):(\w+>)
  $pattern = '/(<\/\w+):(\w+>)/i';
  $replacement = '$1$2';
  $feed = preg_replace($pattern, $replacement, $feed);
  return $feed;
}
