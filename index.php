<?php
/**
 * Simple front controller for hosts that point the document root at the project
 * root instead of the Laravel /public directory.
 *
 * It just redirects to /public/ where the real front controller lives.
 */
header('Location: public/');
exit;
