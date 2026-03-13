<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ $appName }}</title>
   <style>
   body {
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
      background: #f6f7fb;
      color: #111827;
   }

   .container {
      max-width: 760px;
      margin: 40px auto;
      padding: 0 20px;
   }

   .card {
      background: #ffffff;
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      padding: 24px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
   }

   h1 {
      margin: 0 0 10px;
      font-size: 28px;
   }

   .subtitle {
      color: #6b7280;
      margin-bottom: 20px;
   }

   .row {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #f3f4f6;
   }

   .row:last-child {
      border-bottom: 0;
   }

   .key {
      color: #374151;
      font-weight: 600;
   }

   .value {
      color: #111827;
   }

   .ok {
      color: #047857;
      font-weight: 700;
   }

   .bad {
      color: #b91c1c;
      font-weight: 700;
   }
   </style>
</head>

<body>
   <div class="container">
      <div class="card">
         <h1>{{ $appName }}</h1>
         <div class="subtitle">API Status Page</div>

         <div class="row">
            <div class="key">Version</div>
            <div class="value">{{ $version }}</div>
         </div>
         <div class="row">
            <div class="key">Environment</div>
            <div class="value">{{ $environment }}</div>
         </div>
         <div class="row">
            <div class="key">Laravel</div>
            <div class="value">{{ $laravelVersion }}</div>
         </div>
         <div class="row">
            <div class="key">PHP</div>
            <div class="value">{{ $phpVersion }}</div>
         </div>
         <div class="row">
            <div class="key">Database</div>
            <div class="value {{ $databaseStatus === 'connected' ? 'ok' : 'bad' }}">{{ $databaseStatus }}</div>
         </div>
      </div>
   </div>
</body>

</html>