<?php
require 'vendor/autoload.php';

// Test if PHPMailer is loaded
if (class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    echo "PHPMailer is working!";
} else {
    echo "PHPMailer is not installed or not loaded.";
}
