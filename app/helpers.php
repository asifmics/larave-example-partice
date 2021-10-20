<?php
function doUploadImage($path, $photo,$unlink = null)
{

    $imageName = md5(time() . time()) . '.' . $photo->getClientOriginalExtension();
    $photo->move(public_path($path), $imageName);
    return $imageName;
}
