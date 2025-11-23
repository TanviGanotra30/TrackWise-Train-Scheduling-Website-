<?php
// pnrs.php - PNR Status Check Page (Trackwise Theme - Reverted)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PNR Status | Trackwise</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* --- Trackwise Theme CSS (Restored and Adapted) --- */
    :root {
      /* Trackwise Colors */
      --primary: #00B8A9;       /* Teal */
      --primary-light: #5CD6CC;
      --secondary: #2D4059;      /* Dark Blue */
      --accent1: #FF7043;        /* Orange */
      --accent2: #5C6BC0;        /* Indigo */
      --accent3: #26A69A;        /* Another Teal */
      --light: #F5F5F5;
      --dark: #333;
      --gray: #777;
      --success: #4CAF50;        /* Green */
      --warning: #FFC107;        /* Yellow */
      --danger: #F44336;         /* Red */
      --info: #2196F3;           /* Blue */

      /* Light Mode Theme */
      --text-light-mode: #2D4059; /* Dark Blue */
      --bg-light-mode: #f0f8ff;  /* Alice Blue */
      --card-bg-light-mode: #ffffff;
      --header-bg-light-mode: rgba(255, 255, 255, 0.95);
      --border-light-mode: #ddd;
      --table-header-bg-light: #f3f4f6; /* Light Gray */
      --detail-item-bg-light: #f8f9fa; /* Very Light Gray */

      /* Dark Mode Theme */
      --text-dark-mode: #e6e6ff;  /* Light Lavender */
      --bg-dark-mode: #1a1a2e;   /* Dark Navy */
      --card-bg-dark-mode: #16213e; /* Darker Navy */
      --header-bg-dark-mode: rgba(26, 26, 46, 0.95);
      --border-dark-mode: #3d3d6e; /* Dark Purple/Blue */
      --table-header-bg-dark: #2a3a5e; /* Dark Blue/Gray */
      --detail-item-bg-dark: #1e1e3a; /* Slightly Lighter Navy */

      /* Status Color Variables (for consistency) */
      --status-confirmed-bg: #dcfce7;
      --status-confirmed-text: #166534;
      --status-confirmed-icon: var(--success);

      --status-rac-bg: #fef9c3;
      --status-rac-text: #854d0e;
      --status-rac-icon: var(--warning);

      --status-waitlist-bg: #ffedd5; /* Orangish */
      --status-waitlist-text: #9a3412;
      --status-waitlist-icon: var(--accent1);

      --status-cancelled-bg: #fee2e2;
      --status-cancelled-text: #991b1b;
      --status-cancelled-icon: var(--danger);

      --status-default-bg: #e0f2fe;
      --status-default-text: #075985;
      --status-default-icon: var(--info);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

     html {
       scroll-behavior: smooth;
    }

    body {
      background-color: var(--bg-light-mode);
      color: var(--text-light-mode);
      line-height: 1.6;
      transition: background-color 0.3s ease, color 0.3s ease;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    body.dark-mode {
      background-color: var(--bg-dark-mode);
      color: var(--text-dark-mode);
      /* Adjust status colors for dark mode if needed */
       --status-confirmed-bg: #1f2937; /* Darker green bg */
       --status-confirmed-text: #6ee7b7; /* Lighter green text */
       --status-rac-bg: #3730a3; /* Darker yellow/indigo bg */
       --status-rac-text: #fef08a; /* Lighter yellow text */
       --status-waitlist-bg: #451a03; /* Darker orange bg */
       --status-waitlist-text: #fed7aa; /* Lighter orange text */
       --status-cancelled-bg: #450a0a; /* Darker red bg */
       --status-cancelled-text: #fca5a5; /* Lighter red text */
       --status-default-bg: #1e3a8a; /* Darker blue bg */
       --status-default-text: #bfdbfe; /* Lighter blue text */
    }

    /* --- Header Styles (Trackwise) --- */
    header {
      background-color: var(--header-bg-light-mode);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
      border-bottom: 2px solid var(--primary);
      transition: background-color 0.3s ease, border-bottom-color 0.3s ease;
    }

    body.dark-mode header {
      background-color: var(--header-bg-dark-mode);
      border-bottom-color: var(--accent2);
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .header-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 0;
      flex-wrap: wrap;
      gap: 15px;
    }

    .logo {
      display: flex;
      align-items: center;
      text-decoration: none;
    }

    .logo img {
      height: 40px;
      width: auto;
      margin-right: 10px;
    }

    .logo-text {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--secondary);
      transition: color 0.3s ease;
    }

    body.dark-mode .logo-text {
      color: var(--text-dark-mode);
    }

    nav ul {
      display: flex;
      list-style: none;
    }

    nav ul li {
      margin-left: 25px;
    }

    nav ul li a {
      text-decoration: none;
      color: var(--secondary);
      font-weight: 600;
      font-size: 1rem;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: color 0.3s ease;
      padding: 5px 0;
      position: relative;
    }

    nav ul li a.active::after,
    nav ul li a:hover::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 2px;
      background-color: var(--primary);
    }
     body.dark-mode nav ul li a.active::after,
     body.dark-mode nav ul li a:hover::after {
        background-color: var(--primary-light);
     }


    body.dark-mode nav ul li a {
      color: var(--text-dark-mode);
    }

    nav ul li a:hover, nav ul li a.active {
      color: var(--primary);
    }

    body.dark-mode nav ul li a:hover, body.dark-mode nav ul li a.active {
      color: var(--primary-light);
    }

    nav ul li a i {
      font-size: 0.9rem;
    }

    .search-box {
      position: relative;
      flex: 1;
      min-width: 200px;
      max-width: 400px;
      margin: 0 20px;
    }

    .search-box i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
    }

    .search-box input {
      padding: 10px 15px 10px 40px;
      border-radius: 30px;
      border: 1px solid var(--border-light-mode);
      width: 100%;
      font-size: 0.9rem;
      transition: all 0.3s ease;
      background-color: var(--card-bg-light-mode);
      color: var(--text-light-mode);
    }

    body.dark-mode .search-box input {
      background-color: var(--detail-item-bg-dark);
      color: var(--text-dark-mode);
      border-color: var(--border-dark-mode);
    }

    .search-box input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.2);
    }
     body.dark-mode .search-box input:focus {
      border-color: var(--primary-light);
      box-shadow: 0 0 0 3px rgba(92, 214, 204, 0.2);
    }

    .sign-up-btn {
      background-color: var(--primary);
      color: white;
      padding: 10px 20px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: 600;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
      margin-left: auto;
      border: none;
    }

    .sign-up-btn:hover {
      background-color: var(--primary-light);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    body.dark-mode .sign-up-btn {
      background-color: var(--accent2);
      color: white;
    }
     body.dark-mode .sign-up-btn:hover {
      background-color: var(--accent3);
     }


    /* --- Dark Mode Toggle Styles (Trackwise) --- */
    .theme-toggle-container {
      margin-left: 15px;
    }

    .dark-mode-toggle {
      background: transparent;
      border: none;
      color: var(--secondary);
      cursor: pointer;
      font-size: 1.2rem;
      padding: 5px;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .dark-mode-toggle:hover {
      background-color: rgba(45, 64, 89, 0.1);
    }

    body.dark-mode .dark-mode-toggle {
      color: var(--primary-light);
    }

    body.dark-mode .dark-mode-toggle:hover {
      background-color: rgba(92, 214, 204, 0.1);
    }

    .dark-mode-toggle .light-icon { display: inline-block; }
    .dark-mode-toggle .dark-icon { display: none; }
    body.dark-mode .dark-mode-toggle .light-icon { display: none; }
    body.dark-mode .dark-mode-toggle .dark-icon { display: inline-block; }

    /* --- Main Content Styles --- */
    .pnr-section-container {
      max-width: 800px; /* Keep width suitable for table */
      margin: 40px auto;
      padding: 0 20px; /* Use container padding */
      flex: 1;
    }

    h1.page-title {
      color: var(--primary);
      text-align: center;
      margin-bottom: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      font-size: 1.8rem;
    }

    body.dark-mode h1.page-title {
      color: var(--primary-light);
    }

    .card { /* Input Card Style */
      background: var(--card-bg-light-mode);
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      transition: all 0.3s ease;
      border: 1px solid var(--border-light-mode);
    }
    .card p.info-text {
       color: var(--gray);
       margin-bottom: 20px;
       font-size: 0.95rem;
    }


    body.dark-mode .card {
      background: var(--card-bg-dark-mode);
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      border-color: var(--border-dark-mode);
    }
     body.dark-mode .card p.info-text {
        color: var(--text-dark-mode);
        opacity: 0.8;
     }

    .pnr-form {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .pnr-input {
        flex: 1 1 300px;
        padding: 12px 15px;
        border: 1px solid var(--border-light-mode);
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background-color: var(--bg-light-mode); /* Lighter background */
        color: var(--text-light-mode);
        min-width: 200px;
    }

    body.dark-mode .pnr-input {
        background-color: var(--detail-item-bg-dark);
        border-color: var(--border-dark-mode);
        color: var(--text-dark-mode);
    }

    .pnr-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(0, 184, 169, 0.2);
    }

    body.dark-mode .pnr-input:focus {
        border-color: var(--primary-light);
        box-shadow: 0 0 0 3px rgba(92, 214, 204, 0.2);
    }


    .btn { /* Button style from Trackwise */
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px 25px;
      background-color: var(--primary);
      color: white;
      border: none;
      border-radius: 30px; /* Pill shape */
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      flex-shrink: 0;
    }

    body.dark-mode .btn {
      background-color: var(--accent2);
    }

    .btn:hover {
      background-color: var(--primary-light);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    body.dark-mode .btn:hover {
      background-color: var(--accent3);
    }

     .btn:disabled {
        background: #b0bec5;
        color: #607d8b;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
     }
      body.dark-mode .btn:disabled {
         background: #546e7a;
         color: #bdbdbd;
      }


    /* --- Loading and Error States (Trackwise Style) --- */
    .loading {
      display: none;
      text-align: center;
      padding: 30px 0;
      color: var(--gray);
    }
     body.dark-mode .loading {
        color: var(--text-dark-mode);
     }

    .spinner {
      border: 4px solid rgba(0, 0, 0, 0.1);
      border-top: 4px solid var(--primary);
      border-radius: 50%;
      width: 30px;
      height: 30px;
      animation: spin 1s linear infinite;
      margin: 0 auto 15px;
    }

    body.dark-mode .spinner {
        border: 4px solid rgba(255, 255, 255, 0.1);
        border-top-color: var(--primary-light);
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .error-message {
      color: var(--danger);
      padding: 15px;
      background: #ffebee;
      border: 1px solid var(--danger);
      border-radius: 8px;
      margin-top: 20px;
      display: none;
      text-align: center;
      font-weight: 500;
      word-wrap: break-word;
    }
     .error-message i { margin-right: 8px; }
     body.dark-mode .error-message {
        background: #3e1a1e;
        color: #ffcdd2;
        border-color: #e57373;
     }


    /* --- Results Section (Trackwise Style) --- */
    .results {
      display: none;
      margin-top: 30px;
      animation: fadeIn 0.5s ease-out;
      background: var(--card-bg-light-mode);
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      border: 1px solid var(--border-light-mode);
      overflow: hidden;
    }
    body.dark-mode .results {
       background: var(--card-bg-dark-mode);
       box-shadow: 0 4px 12px rgba(0,0,0,0.3);
       border-color: var(--border-dark-mode);
    }


    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .status-header {
      display: flex;
      align-items: center;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 1px solid var(--border-light-mode);
      flex-wrap: wrap;
      gap: 10px;
    }
    body.dark-mode .status-header {
        border-bottom-color: var(--border-dark-mode);
    }

    .status-icon { /* Class added by JS */
      font-size: 24px; /* Larger icon */
      margin-right: 12px;
      flex-shrink: 0;
      /* Color set by status class below */
    }

    .status-text {
      font-weight: 600;
      font-size: 1.2rem;
      color: var(--text-light-mode);
      flex-grow: 1;
      min-width: 150px;
    }
     body.dark-mode .status-text {
        color: var(--text-dark-mode);
     }


    .status-badge { /* Class added by JS */
      display: inline-block;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      margin-left: 15px;
      flex-shrink: 0;
      text-transform: uppercase;
      /* BG and Text Color set by status class below */
    }

    .details-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .detail-item {
      background: var(--detail-item-bg-light);
      padding: 15px;
      border-radius: 8px;
      border: 1px solid #eee; /* Lighter border */
      word-wrap: break-word;
    }
    body.dark-mode .detail-item {
        background: var(--detail-item-bg-dark);
        border-color: var(--border-dark-mode);
    }

    .detail-label {
      font-size: 0.9rem;
      color: var(--gray);
      margin-bottom: 5px;
      display: block;
    }
    body.dark-mode .detail-label {
      color: #a0a0c0;
    }

    .detail-value {
      font-weight: 600;
      font-size: 1rem;
      color: var(--text-light-mode);
    }
     body.dark-mode .detail-value {
        color: var(--text-dark-mode);
     }

    /* Passengers Table Section */
     .passengers-section {
        margin-top: 20px;
    }
    .passengers-section h3 {
        color: var(--primary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.3rem;
    }
    body.dark-mode .passengers-section h3 {
        color: var(--primary-light);
    }

    .table-container {
        overflow-x: auto;
        width: 100%;
        border: 1px solid var(--border-light-mode); /* Add border to container */
        border-radius: 8px;
        margin-top: 5px;
    }
     body.dark-mode .table-container {
        border-color: var(--border-dark-mode);
     }

    .passengers-table {
      width: 100%;
      min-width: 500px;
      border-collapse: collapse;
      /* Remove table border, use container border */
    }

    .passengers-table th {
      background: var(--table-header-bg-light);
      padding: 12px 15px;
      text-align: left;
      font-size: 0.9rem;
      color: var(--secondary);
      font-weight: 600;
      white-space: nowrap;
      position: sticky;
      top: 0;
      z-index: 1;
      border-bottom: 1px solid var(--border-light-mode); /* Ensure header bottom border */
    }
    body.dark-mode .passengers-table th {
        background: var(--table-header-bg-dark);
        color: var(--text-dark-mode);
        border-bottom-color: var(--border-dark-mode);
    }
     /* Remove border from container for header */
     .table-container > .passengers-table > thead > tr > th {
         border-top: none;
     }


    .passengers-table td {
      padding: 12px 15px;
      border-bottom: 1px solid var(--border-light-mode);
      font-size: 0.95rem;
      white-space: nowrap;
      color: var(--text-light-mode); /* Ensure text color is set */
    }
     body.dark-mode .passengers-table td {
        border-bottom-color: var(--border-dark-mode);
        color: var(--text-dark-mode);
     }
     .passengers-table tr:last-child td {
        border-bottom: none;
     }

    .passenger-status { /* Class added by JS */
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      display: inline-block;
      text-transform: uppercase;
      letter-spacing: 0.5px;
       /* BG and Text Color set by status class below */
    }

     /* --- Status Class Styling (Trackwise Colors) --- */
     /* Confirmed */
     .status-icon.status-cnf { color: var(--status-confirmed-icon); }
     .status-badge.status-cnf, .passenger-status.status-cnf {
         background-color: var(--status-confirmed-bg);
         color: var(--status-confirmed-text);
     }
     /* RAC */
     .status-icon.status-rac { color: var(--status-rac-icon); }
     .status-badge.status-rac, .passenger-status.status-rac {
         background-color: var(--status-rac-bg);
         color: var(--status-rac-text);
     }
     /* Waitlisted (WL, PQWL, RLWL, TQWL, GNWL) */
     .status-icon.status-wl, .status-icon.status-pqwl, .status-icon.status-rlwl,
     .status-icon.status-tqwl, .status-icon.status-gnwl { color: var(--status-waitlist-icon); }
     .status-badge.status-wl, .passenger-status.status-wl,
     .status-badge.status-pqwl, .passenger-status.status-pqwl,
     .status-badge.status-rlwl, .passenger-status.status-rlwl,
     .status-badge.status-tqwl, .passenger-status.status-tqwl,
     .status-badge.status-gnwl, .passenger-status.status-gnwl {
         background-color: var(--status-waitlist-bg);
         color: var(--status-waitlist-text);
     }
     /* Cancelled (CAN, WEBCAN) */
     .status-icon.status-can, .status-icon.status-webcan { color: var(--status-cancelled-icon); }
     .status-badge.status-can, .passenger-status.status-can,
     .status-badge.status-webcan, .passenger-status.status-webcan {
         background-color: var(--status-cancelled-bg);
         color: var(--status-cancelled-text);
     }
     /* Default / Unknown / NOSB */
     .status-icon.status-default, .status-icon.status-nosb { color: var(--status-default-icon); }
     .status-badge.status-default, .passenger-status.status-default,
     .status-badge.status-nosb, .passenger-status.status-nosb {
         background-color: var(--status-default-bg);
         color: var(--status-default-text);
     }

    /* --- Footer Styles (Trackwise) --- */
    footer {
      background-color: var(--light);
      color: var(--dark);
      padding: 60px 0 20px;
      margin-top: auto;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    body.dark-mode footer {
      background-color: #1a1a1a;
      color: var(--text-dark-mode);
    }

    .footer-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 40px;
      margin-bottom: 40px;
    }

    .footer-column h3 {
      font-size: 1.3rem;
      margin-bottom: 20px;
      color: var(--secondary);
      position: relative;
      padding-bottom: 10px;
    }

    body.dark-mode .footer-column h3 {
      color: var(--text-dark-mode);
    }

    .footer-column h3::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 50px;
      height: 2px;
      background-color: var(--primary);
    }
     body.dark-mode .footer-column h3::after {
        background-color: var(--accent2);
     }

    .footer-column p {
      margin-bottom: 20px;
      color: var(--gray);
      font-size: 0.95rem;
      word-wrap: break-word;
    }

    body.dark-mode .footer-column p {
      color: #b0b0d0;
    }

    .social-links {
      display: flex;
      gap: 15px;
    }

    .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: #e0e0e0;
      color: var(--secondary);
      transition: all 0.3s ease;
      text-decoration: none;
    }

    body.dark-mode .social-links a {
      background-color: #2d2d4d;
      color: var(--text-dark-mode);
    }

    .social-links a:hover {
      background-color: var(--primary);
      color: white;
      transform: translateY(-3px);
    }
    body.dark-mode .social-links a:hover {
       background-color: var(--accent2);
    }

    .footer-column ul { list-style: none; }
    .footer-column ul li { margin-bottom: 12px; }
    .footer-column ul li a {
      color: var(--gray);
      text-decoration: none;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 0.95rem;
    }
    body.dark-mode .footer-column ul li a { color: #b0b0d0; }
    .footer-column ul li a:hover { color: var(--primary); padding-left: 5px; }
    body.dark-mode .footer-column ul li a:hover { color: var(--primary-light); }
    .footer-column ul li a i.fa-chevron-right {
      font-size: 0.7rem;
      color: var(--primary);
      transition: color 0.3s ease;
    }
     body.dark-mode .footer-column ul li a i.fa-chevron-right { color: var(--accent2); }

    .copyright {
      text-align: center;
      padding-top: 20px;
      border-top: 1px solid var(--border-light-mode);
      color: var(--gray);
      font-size: 0.9rem;
    }
    body.dark-mode .copyright {
      border-top-color: var(--border-dark-mode);
      color: #b0b0d0;
    }

    /* --- Back to Top Button (Trackwise) --- */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background-color: var(--primary);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      z-index: 999;
      border: none;
    }
     body.dark-mode .back-to-top { background-color: var(--accent2); }
    .back-to-top.visible { opacity: 1; visibility: visible; }
    .back-to-top:hover {
      background-color: var(--primary-light);
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    body.dark-mode .back-to-top:hover { background-color: var(--accent3); }

    /* Toggle Animation */
    .toggle-animate { animation: pulse 0.5s ease; }
    @keyframes pulse {
      0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); }
    }

    /* --- Responsive Styles (Trackwise Base) --- */
    @media (max-width: 992px) {
      .header-content { gap: 15px; }
      nav { order: 1; width: auto; margin-top: 0; }
      .search-box { order: 2; margin: 0; flex: 1; min-width: 150px; }
      .sign-up-btn { order: 3; margin-left: 0; }
      .theme-toggle-container { order: 4; margin-left: 0; }
    }
    @media (max-width: 768px) {
      .container { max-width: 100%; } /* Allow full width */
      h1.page-title { font-size: 1.6rem; }
      .pnr-section-container { margin: 20px auto; padding: 0 15px; } /* Reduce margins */
      .card, .results { padding: 20px; }
      .pnr-form { flex-direction: column; align-items: stretch; }
      .btn { width: 100%; }
      .details-grid { grid-template-columns: 1fr; gap: 15px; }
      .header-content { gap: 10px; }
      nav ul li { margin-left: 15px; }
      .logo-text { font-size: 1.3rem; }
    }
    @media (max-width: 576px) {
      .header-content { justify-content: space-between; }
      .logo { order: 1; }
      .theme-toggle-container { order: 2; }
      nav { order: 4; width: 100%; margin-top: 15px; }
      nav ul { justify-content: space-around; padding: 0;}
      nav ul li { margin-left: 0; }
      .search-box { order: 3; width: 100%; margin: 10px 0; }
      .sign-up-btn { order: 5; width: 100%; margin-top: 10px; }
      .passengers-table th, .passengers-table td { font-size: 0.85rem; padding: 8px 10px; }
      .status-badge, .passenger-status { font-size: 0.8rem; padding: 3px 8px; }
      .pnr-input, .btn { font-size: 0.95rem; }
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <div class="header-content">
        <a href="/trackwise/home.html" class="logo">
           <img src="/trackwise/train.png" alt="Trackwise Logo">
          <span class="logo-text">Trackwise</span>
        </a>
        <nav>
          <ul>
            <li><a href="/trackwise/home.html"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="/trackwise/discoverviolet.html"><i class="fas fa-compass"></i> Discover</a></li>
            <li><a href="/trackwise/about.html"><i class="fas fa-info-circle"></i> About</a></li>
            <li><a href="/trackwise/contact.html"><i class="fas fa-envelope"></i> Contact</a></li>
            <li><a href="pnrs.php" class="active"><i class="fas fa-ticket-alt"></i> PNR</a></li>
          </ul>
        </nav>
        <div class="search-box">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Search trains or stations...">
        </div>
        <a href="/trackwise/signup.html" class="sign-up-btn"><i class="fas fa-user-plus"></i> Sign up</a>
        <div class="theme-toggle-container">
          <button id="dark-mode-toggle" class="dark-mode-toggle" aria-label="Toggle dark mode">
            <span class="toggle-icon">
              <i class="fas fa-moon light-icon"></i>
              <i class="fas fa-sun dark-icon"></i>
            </span>
          </button>
        </div>
      </div>
    </div>
  </header>

  <main class="pnr-section-container container"> <h1 class="page-title"><i class="fas fa-search"></i> PNR Status Check</h1>

    <div class="card">
        <p class="info-text">Enter your 10-digit Indian Railways PNR number below.</p>
        <div class="pnr-form">
            <input type="text" id="pnrInput" class="pnr-input" placeholder="e.g. 1234567890" maxlength="10" inputmode="numeric">
            <button id="checkPnrBtn" class="btn">
                <i class="fas fa-check-circle"></i> Check Status
            </button>
        </div>
    </div>

    <div class="loading" id="loading">
        <div class="spinner"></div>
        <p>Fetching PNR details...</p>
    </div>

    <div class="error-message" id="errorMessage"></div>

    <div class="results" id="results">
        <div class="status-header">
            <i class="fas fa-circle status-icon" id="statusIcon"></i> <span class="status-text" id="statusText">Status</span>
            <span class="status-badge" id="statusBadge">TYPE</span>
        </div>

        <div class="details-grid">
            <div class="detail-item">
                <span class="detail-label">Train Number</span>
                <span class="detail-value" id="trainNumber">-</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Train Name</span>
                <span class="detail-value" id="trainName">-</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Journey Date</span>
                <span class="detail-value" id="journeyDate">-</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Class</span>
                <span class="detail-value" id="journeyClass">-</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">From Station</span>
                <span class="detail-value" id="fromStation">-</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">To Station</span>
                <span class="detail-value" id="toStation">-</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Chart Status</span>
                <span class="detail-value" id="chartStatus">-</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Booking Date</span>
                <span class="detail-value" id="bookingDate">-</span>
            </div>
        </div>

        <div class="passengers-section">
             <h3><i class="fas fa-users"></i> Passenger Details</h3>
             <div class="table-container">
                 <table class="passengers-table">
                     <thead>
                         <tr>
                             <th>No.</th>
                             <th>Booking Status</th>
                             <th>Current Status</th>
                             <th>Coach/Seat</th>
                         </tr>
                     </thead>
                     <tbody id="passengerTableBody">
                          <tr><td colspan="4" style="text-align:center; color: var(--gray); padding: 20px;">Enter PNR above to see details</td></tr>
                     </tbody>
                 </table>
             </div>
        </div>
    </div>
  </main>

  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <h3>Trackwise</h3>
          <p>Making rail travel easier and more predictable across India.</p>
          <div class="social-links">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="footer-column">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="/trackwise/home.html"><i class="fas fa-chevron-right"></i> Home</a></li>
            <li><a href="/trackwise/discoverviolet.html"><i class="fas fa-chevron-right"></i> Discover</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Book Tickets</a></li>
            <li><a href="pnrs.php"><i class="fas fa-chevron-right"></i> PNR Status</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Train Schedule</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Information</h3>
          <ul>
            <li><a href="/trackwise/about.html"><i class="fas fa-chevron-right"></i> About Us</a></li>
            <li><a href="/trackwise/contact.html"><i class="fas fa-chevron-right"></i> Contact</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Privacy Policy</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> Terms of Service</a></li>
            <li><a href="#"><i class="fas fa-chevron-right"></i> FAQ</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Contact Us</h3>
          <ul>
            <li><a href="#"><i class="fas fa-map-marker-alt"></i> 123 Railway Nagar, Amritsar</a></li>
            <li><a href="mailto:info@trackwise.com"><i class="fas fa-envelope"></i> info@trackwise.com</a></li>
            <li><a href="tel:+911234567890"><i class="fas fa-phone"></i> +91 12345 67890</a></li>
            <li><a href="#"><i class="fas fa-clock"></i> 24/7 Customer Support</a></li>
          </ul>
        </div>
      </div>
      <div class="copyright">
         &copy; <?php echo date("Y"); ?> Trackwise. All rights reserved. | Designed with <i class="fas fa-heart" style="color: #ff4757;"></i> for train travelers
      </div>
    </div>
  </footer>

  <button class="back-to-top" id="backToTop" aria-label="Back to top">
    <i class="fas fa-arrow-up"></i>
  </button>

    <script>
        // --- API Configuration ---
        const RAPIDAPI_KEY = '3d86c2d6aemshdc9a7b41679cbaep166b94jsnf3b7c3893b4f'; // Your API Key
        const RAPIDAPI_HOST = 'irctc-indian-railway-pnr-status.p.rapidapi.com';
        const API_URL = https://${RAPIDAPI_HOST}/getPNRStatus/;

        // --- DOM Elements ---
        const pnrInput = document.getElementById('pnrInput');
        const checkBtn = document.getElementById('checkPnrBtn');
        const loadingElement = document.getElementById('loading');
        const errorElement = document.getElementById('errorMessage');
        const resultsElement = document.getElementById('results');
        const passengerTableBody = document.getElementById('passengerTableBody');
        const statusIconEl = document.getElementById('statusIcon');
        const statusTextEl = document.getElementById('statusText');
        const statusBadgeEl = document.getElementById('statusBadge');
        const trainNumberEl = document.getElementById('trainNumber');
        const trainNameEl = document.getElementById('trainName');
        const journeyDateEl = document.getElementById('journeyDate');
        const journeyClassEl = document.getElementById('journeyClass');
        const fromStationEl = document.getElementById('fromStation');
        const toStationEl = document.getElementById('toStation');
        const chartStatusEl = document.getElementById('chartStatus');
        const bookingDateEl = document.getElementById('bookingDate');
        const darkModeToggle = document.getElementById('dark-mode-toggle'); // Reference for theme toggle
        const backToTopButton = document.getElementById('backToTop'); // Reference for back-to-top
        let lastPnrData = null; // Store last successful data


        // Status text mapping (can be used for badge text)
        const statusTextMap = {
            'cnf': 'Confirmed', 'rac': 'RAC', 'wl': 'Waitlist',
            'can': 'Cancelled', 'pqwl': 'PQWL', 'rlwl': 'RLWL',
            'tqwl': 'TQWL', 'gnwl': 'GNWL', 'nosb': 'No Seat',
            'webcan': 'Web Cancel', 'default': 'Unknown'
        };


        // --- PNR Status Check Logic ---
        async function checkPnrStatus() {
            const pnrNumber = pnrInput.value.trim();
            if (!pnrNumber || !/^\d{10}$/.test(pnrNumber)) {
                showError('Please enter a valid 10-digit PNR number.');
                pnrInput.focus();
                return;
            }
            hideError();
            resultsElement.style.display = 'none';
            loadingElement.style.display = 'block';
            checkBtn.disabled = true;
            passengerTableBody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding: 20px;"><div class="spinner" style="margin: auto;"></div></td></tr>';
            const btnIcon = checkBtn.querySelector('i');
            if (btnIcon) btnIcon.className = 'fas fa-spinner fa-spin'; // Use spinner icon from Font Awesome

            try {
                const response = await fetch(${API_URL}${pnrNumber}, {
                    method: 'GET',
                    headers: {
                        'x-rapidapi-host': RAPIDAPI_HOST,
                        'x-rapidapi-key': RAPIDAPI_KEY
                    }
                });
                if (!response.ok) {
                    let errorMsg = API Request Failed;
                    try {
                        const errorData = await response.json();
                        errorMsg = ${errorData.message || response.statusText || 'Unknown API Error'} (Status: ${response.status});
                    } catch (e) { errorMsg = API Request Failed: ${response.status} ${response.statusText}; }
                    throw new Error(errorMsg);
                }
                const data = await response.json();
                 if (!data || data.success === false || !data.data || !data.data.passengerList) {
                    const apiMessage = data ? data.message : 'Invalid response from API';
                    throw new Error(apiMessage || 'Invalid PNR or data not found.');
                }
                lastPnrData = data.data;
                displayPnrDetails(data.data);
            } catch (error) {
                console.error('Error fetching PNR status:', error);
                 let displayError = 'Failed to fetch PNR details. Please check PNR number and network connection.';
                 if (error.message.includes('API Request Failed') || error.message.includes('Status: 4')) {
                      displayError = Could not retrieve status. ${error.message}. Please verify PNR & API key/subscription.;
                 } else if (error.message.includes('Status: 5')) {
                     displayError = PNR service unavailable (${error.message}). Please try again later.;
                 } else if (error.message.includes('Invalid PNR') || error.message.includes('not found')) {
                      displayError = Error: ${error.message}. Please check the PNR number.;
                 } else if (error instanceof TypeError && error.message.includes('fetch')) {
                     displayError = 'Network error. Please check your internet connection.';
                 }
                 showError(displayError);
                 passengerTableBody.innerHTML = <tr><td colspan="4" style="text-align:center; color: var(--danger); padding: 20px;">${displayError}</td></tr>;
                 lastPnrData = null;
            } finally {
                loadingElement.style.display = 'none';
                checkBtn.disabled = false;
                if (btnIcon) btnIcon.className = 'fas fa-check-circle'; // Restore original icon
            }
        }

        // --- Display PNR Details ---
        function displayPnrDetails(data) {
            if (!data || !data.passengerList || data.passengerList.length === 0) {
                showError('No passenger data found for this PNR.');
                 passengerTableBody.innerHTML = <tr><td colspan="4" style="text-align:center; color: var(--gray); padding: 20px;">No passenger data found.</td></tr>;
                return;
            }

            // Update basic info
            trainNumberEl.textContent = data.trainNumber || '-';
            trainNameEl.textContent = data.trainName || 'N/A';
            journeyDateEl.textContent = formatDate(data.dateOfJourney) || '-';
            fromStationEl.textContent = ${data.sourceStation || '?'} (${data.sourceStationCode || '?'});
            toStationEl.textContent = ${data.destinationStation || '?'} (${data.destinationStationCode || '?'});
            journeyClassEl.textContent = data.journeyClass || '-';
             let chartDisplayText = data.chartStatus;
              if (typeof data.chartStatus === 'boolean') {
                  chartDisplayText = data.chartStatus ? "CHART PREPARED" : "CHART NOT PREPARED";
              }
             chartStatusEl.textContent = chartDisplayText || 'N/A';
            bookingDateEl.textContent = formatDate(data.bookingDate) || '-';

            // Set overall status based on first passenger
            const firstPassenger = data.passengerList[0];
            const mainStatusCode = (firstPassenger.currentStatus || firstPassenger.bookingStatus || '').split('/')[0].trim().toLowerCase() || 'default';

            // Update status header using CSS classes
            statusIconEl.className = fas fa-circle status-icon status-${mainStatusCode}; // Set class for styling
            statusTextEl.textContent = getStatusText(firstPassenger);
            statusBadgeEl.className = status-badge status-${mainStatusCode}; // Set class for styling
            statusBadgeEl.textContent = statusTextMap[mainStatusCode] || mainStatusCode.toUpperCase();
            statusBadgeEl.style.display = (mainStatusCode !== 'default' && statusTextMap[mainStatusCode]) ? 'inline-block' : 'none';

            // Update passenger table
            passengerTableBody.innerHTML = ''; // Clear placeholder/old data
            data.passengerList.forEach(passenger => {
                const row = document.createElement('tr');
                const passengerStatusCode = (passenger.currentStatus || passenger.bookingStatus || '').split('/')[0].trim().toLowerCase() || 'default';
                const coach = passenger.currentCoachId || passenger.bookingCoachId || '';
                const berth = passenger.currentBerthNo || passenger.bookingBerthNo || '';
                const berthType = passenger.currentBerthCode || passenger.bookingBerthCode || '';
                let seatInfo = (coach || berth) ? ${coach}${coach && berth ? '/' : ''}${berth} : '-';
                if (seatInfo !== '-' && berthType) seatInfo += ` (${berthType})`;
                const bookingStatusDetail = passenger.bookingStatusDetails || passenger.bookingStatus || '-';
                const currentStatusDetail = passenger.currentStatusDetails || passenger.currentStatus || bookingStatusDetail;
                const statusSpanClass = passenger-status status-${passengerStatusCode};

                row.innerHTML = `
                    <td>${passenger.passengerSerialNumber || '-'}</td>
                    <td>${bookingStatusDetail}</td>
                    <td><span class="${statusSpanClass}">${currentStatusDetail}</span></td>
                    <td>${seatInfo}</td>
                `;
                passengerTableBody.appendChild(row);
            });

            resultsElement.style.display = 'block';
        }

        // --- Helper Functions ---
        function getStatusText(passenger) {
             if (!passenger) return 'Status Unavailable';
             const currentStatus = (passenger.currentStatus || '').toUpperCase();
             const bookingStatus = (passenger.bookingStatus || '').toUpperCase();
             const currentDetail = passenger.currentStatusDetails || currentStatus;
             const displayDetail = currentDetail || passenger.bookingStatusDetails || bookingStatus || 'Status Unavailable';

             if (currentStatus.startsWith('CAN') || currentStatus.startsWith('WEBCAN')) return 'Ticket Cancelled';
             if (currentStatus.startsWith('CNF')) {
                 const coach = passenger.currentCoachId || passenger.bookingCoachId;
                 const berth = passenger.currentBerthNo || passenger.bookingBerthNo;
                 const berthType = passenger.currentBerthCode || passenger.bookingBerthCode || '';
                 if (coach && berth) {
                      let confirmedText = Confirmed (${coach}/${berth};
                      if(berthType) confirmedText += ` ${berthType}`;
                      confirmedText += ')';
                      return confirmedText;
                 } else { return 'Confirmed (Check Chart)'; }
             }
             return displayDetail;
        }

        function formatDate(dateString) {
            if (!dateString) return '-';
            try {
                const date = new Date(dateString);
                if (isNaN(date.getTime())) {
                     if (/^\d{2}-\d{2}-\d{4}$/.test(dateString)) {
                         const parts = dateString.split('-');
                         const isoDate = ${parts[2]}-${parts[1]}-${parts[0]};
                         const retryDate = new Date(isoDate);
                         if (!isNaN(retryDate.getTime())) {
                              return retryDate.toLocaleDateString('en-GB', { year: 'numeric', month: 'short', day: 'numeric' });
                         }
                     }
                    return dateString;
                }
                return date.toLocaleDateString('en-GB', { year: 'numeric', month: 'short', day: 'numeric' });
            } catch (e) { return dateString; }
        }

        function showError(message) {
            errorElement.innerHTML = <i class="fas fa-exclamation-triangle"></i> ${message};
            errorElement.style.display = 'block';
            resultsElement.style.display = 'none';
        }

        function hideError() {
            errorElement.style.display = 'none';
            errorElement.textContent = '';
        }

        // --- Event Listeners ---
        checkBtn.addEventListener('click', checkPnrStatus);
        pnrInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') { e.preventDefault(); checkPnrStatus(); }
        });
        pnrInput.addEventListener('input', function (e) {
            let value = this.value.replace(/[^0-9]/g, '');
            if (value.length > 10) value = value.slice(0, 10);
            this.value = value;
        });

        // --- Dark Mode Toggle Functionality (Trackwise) ---
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

        function applyDarkMode(isDark) {
            const body = document.body;
            const toggleButton = darkModeToggle;
            if (isDark) {
                body.classList.add('dark-mode');
                if (toggleButton) {
                    toggleButton.querySelector('.light-icon').style.display = 'none';
                    toggleButton.querySelector('.dark-icon').style.display = 'inline-block';
                    toggleButton.setAttribute('aria-label', 'Disable dark mode');
                }
            } else {
                body.classList.remove('dark-mode');
                if (toggleButton) {
                    toggleButton.querySelector('.light-icon').style.display = 'inline-block';
                    toggleButton.querySelector('.dark-icon').style.display = 'none';
                    toggleButton.setAttribute('aria-label', 'Enable dark mode');
                }
            }
            // Re-display results if they were visible to update styles
            // Note: This relies on lastPnrData being stored correctly
            // if (resultsElement.style.display === 'block' && lastPnrData) {
            //     displayPnrDetails(lastPnrData); // May cause a slight flicker
            // }
        }

        function initDarkMode() {
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
                applyDarkMode(true);
            } else {
                applyDarkMode(false);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            initDarkMode();
             if (!lastPnrData) {
                  passengerTableBody.innerHTML = '<tr><td colspan="4" style="text-align:center; color: var(--gray); padding: 20px;">Enter PNR above to see details</td></tr>';
             }
        });

        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', function() {
                const isDarkMode = !document.body.classList.contains('dark-mode');
                applyDarkMode(isDarkMode);
                localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
                this.classList.add('toggle-animate');
                setTimeout(() => { this.classList.remove('toggle-animate'); }, 300);
            });
        }

         window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
             if (!localStorage.getItem('theme')) { applyDarkMode(e.matches); }
         });
         window.addEventListener('storage', function(event) {
             if (event.key === 'theme') { applyDarkMode(event.newValue === 'dark'); }
         });

        // --- Back to top button functionality (Trackwise) ---
        if (backToTopButton) {
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) { backToTopButton.classList.add('visible'); }
                else { backToTopButton.classList.remove('visible'); }
            });
            backToTopButton.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

    </script>

</body>
</html>