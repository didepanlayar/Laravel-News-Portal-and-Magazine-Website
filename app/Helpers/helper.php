<?php

/**
 * Format News Tags
 */
function formatTags(array $tags): String
{
    return implode(',', $tags);
}