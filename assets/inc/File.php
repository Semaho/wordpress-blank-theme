<?php

class File
{
    /**
     *  Upload file on server.
     * @param    mixed[]        $file_array Entry of $_FILES array (like $_FILES['my-file']).
     * @return   string|false   The filename, or false if an error occured.
     */

    public static function upload($file_array, $max_size = 5000000, $allowed_types = [])
    {
        if ( !File::verify_array($file_array) )
            return new WP_Error('unexpected_file_array', __('Unexpected file array.', 'seb'));

        $extension = strtolower(pathinfo(basename($file_array["name"]),PATHINFO_EXTENSION));
        
        // Check file size.
        if ($file_array["size"] > $max_size)
            return new WP_Error('filesize_exceeded', __('Sorry, your file is too large.', 'seb'));

        // Check file extension.
        if ( !empty($allowed_types) && !in_array($extension, $allowed_types) )
            return new WP_Error('filetype_not_allowed', __('Sorry, this file type is not allowed.', 'seb'));

        // Upload file.
        return wp_upload_bits($file_array['name'], null, file_get_contents($file_array['tmp_name']));
    }


    /**
     * Shorthand function to upload an image.
     * Default file size 5Mo.
     * Allowed types : jpg, jpeg, png.
     */

    public static function upload_image($file_array)
    {
        if ( !File::verify_array($file_array) )
            return new WP_Error('unexpected_file_array', __('Unexpected file array.', 'seb'));
            
        // Check if image file is a actual image or fake image
        if ( getimagesize($file_array["tmp_name"]) === false )
            return new WP_Error('image_has_no_size', __('This image has no size.', 'seb'));

        return File::upload($file_array, $max_size = 5000000, $allowed_types = ["jpg", "jpeg", "png"]);
    }


    /**
     * Check that every expected keys of $file_array have a value.
     */

    private static function verify_array($file_array)
    {
        return !empty($file_array['name']) && !empty($file_array['type']) && !empty($file_array['tmp_name']) && !empty($file_array['size']);
    }
}