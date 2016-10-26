<?


function activeMenu ($url)
{
  $path = $_SERVER['REQUEST_URI'];

  return $path == $url ? 'class=active' : '';
}
