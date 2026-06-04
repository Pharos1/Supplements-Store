<?php
require 'config.php';

// Simple Security: Only let logged-in users see this (In a real app, you'd check for an 'is_admin' column)


$content = 'pages/admin_panel.php';
include 'layout.php';
