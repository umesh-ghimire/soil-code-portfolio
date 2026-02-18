<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: #2a332b;
            background-color: #fff9ed;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 80px 20px 80px 20px;
            overflow: hidden;
            box-shadow: 0 20px 30px -15px rgba(44, 62, 47, 0.08);
            border: 1px solid #eac5b0;
        }
        .header {
            background: linear-gradient(145deg, #c17b5c, #b46a4a);
            color: white;
            padding: 40px 30px;
            text-align: center;
            border-bottom: 5px solid #2a4230;
        }
        .content {
            padding: 40px;
        }
        .message-details {
            background: rgba(193, 123, 92, 0.05);
            border: 1px solid #eac5b0;
            border-radius: 60px 20px 60px 20px;
            padding: 30px;
            margin: 20px 0;
        }
        .detail-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #eac5b0;
        }
        .detail-label {
            font-weight: 700;
            color: #2a4230;
            display: block;
            margin-bottom: 5px;
        }
        .detail-value {
            color: #2a332b;
        }
        .btn {
            display: inline-block;
            background: #c17b5c;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 60px 20px 60px 20px;
            font-weight: 600;
            margin-top: 20px;
        }
        .btn:hover {
            background: #4c6b4a;
        }
        .footer {
            background: #2a4230;
            color: #e3dbcf;
            padding: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">🌱 New Seed Planted</h1>
            <p style="margin: 10px 0 0;">A new message has arrived</p>
        </div>
        
        <div class="content">
            <p style="font-size: 18px;">Hello,</p>
            
            <p>A new contact message has been received:</p>
            
            <div class="message-details">
                <div class="detail-item">
                    <span class="detail-label">From:</span>
                    <span class="detail-value">{{ $message->name }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">{{ $message->email }}</span>
                </div>
                
                @if($message->phone)
                <div class="detail-item">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">{{ $message->phone }}</span>
                </div>
                @endif
                
                <div class="detail-item">
                    <span class="detail-label">Subject:</span>
                    <span class="detail-value">{{ $message->subject }}</span>
                </div>
                
                <div>
                    <span class="detail-label">Message:</span>
                    <p class="detail-value">{{ $message->message }}</p>
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ url('/admin/messages/' . $message->id) }}" class="btn">
                    View in Dashboard
                </a>
            </div>
        </div>
        
        <div class="footer">
            <p style="margin: 0;">This is an automated notification from your portfolio website.</p>
        </div>
    </div>
</body>
</html>