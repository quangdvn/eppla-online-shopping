<?php
    //* Built-in helper functions through-out the Project
    function presentPrice($price)
    {
        return '$' . number_format($price / 100, 2);
    }

    function setActive($queryString, $contentSlug, $output = 'active')
    {
        return $queryString == $contentSlug ? $output : '';
    }
