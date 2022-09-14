<?php

/**
 * Multibyte String Pad
 *
 * Functionally, the equivalent of the standard str_pad function, but is capable of successfully padding multibyte strings.
 *
 * @param string $input The string to be padded.
 * @param int $length The length of the resultant padded string.
 * @param string $padding The string to use as padding. Defaults to space.
 * @param int $padType The type of padding. Defaults to STR_PAD_RIGHT.
 * @param string $encoding The encoding to use, defaults to UTF-8.
 *
 * @return string A padded multibyte string.
 */
function mb_str_pad($input, $length, $padding = ' ', $padType = STR_PAD_RIGHT, $encoding = 'UTF-8')
{
    $result = $input;
    if (($paddingRequired = $length - mb_strlen($input, $encoding)) > 0) {
        switch ($padType) {
            case STR_PAD_LEFT:
                $result =
                    mb_substr(str_repeat($padding, $paddingRequired), 0, $paddingRequired, $encoding).
                    $input;
                break;
            case STR_PAD_RIGHT:
                $result =
                    $input.
                    mb_substr(str_repeat($padding, $paddingRequired), 0, $paddingRequired, $encoding);
                break;
            case STR_PAD_BOTH:
                $leftPaddingLength = floor($paddingRequired / 2);
                $rightPaddingLength = $paddingRequired - $leftPaddingLength;
                $result =
                    mb_substr(str_repeat($padding, $leftPaddingLength), 0, $leftPaddingLength, $encoding).
                    $input.
                    mb_substr(str_repeat($padding, $rightPaddingLength), 0, $rightPaddingLength, $encoding);
                break;
        }
    }

    return $result;
}