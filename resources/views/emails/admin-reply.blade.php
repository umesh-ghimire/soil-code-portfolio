<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response to your message</title>
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
            background: linear-gradient(145deg, #4c6b4a, #2a4230);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            border-bottom: 5px solid #c17b5c;
        }
        .header::after {
            content: '🌱';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 40px;
            background: white;
            width: 60px;
            height: 60px;
            border-radius: 30% 50% 30% 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4c6b4a;
            border: 3px solid #c17b5c;
        }
        .content {
            padding: 50px 40px;
            background: white;
        }
        .greeting {
            font-size: 18px;
            color: #2a4230;
            margin-bottom: 20px;
        }
        .reply-box {
            background: rgba(193, 123, 92, 0.05);
            border: 1px solid #eac5b0;
            border-radius: 60px 20px 60px 20px;
            padding: 30px;
            margin: 30px 0;
            border-left: 5px solid #c17b5c;
        }
        .reply-box h3 {
            color: #2a4230;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        .original-message {
            background: #e3dbcf;
            border-radius: 40px 12px 40px 12px;
            padding: 25px;
            margin: 30px 0;
            font-size: 14px;
            color: #2a332b;
        }
        .original-label {
            font-weight: 700;
            color: #2a4230;
            margin-bottom: 10px;
            display: block;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .signature {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px dashed #eac5b0;
        }
        .signature-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2a4230;
            margin-bottom: 5px;
        }
        .signature-title {
            color: #c17b5c;
            font-style: italic;
            margin-bottom: 10px;
        }
        .footer {
            background: #2a4230;
            color: #e3dbcf;
            padding: 30px;
            text-align: center;
            font-size: 14px;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">🌱 A Seed Has Grown</h1>
            <p style="margin: 10px 0 0; opacity: 0.9;">Reply to your message</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                {{-- Use $contactMessage instead of $message --}}
                <p>Dear <strong>{{ $contactMessage->name }}</strong>,</p>
            </div>
            
            {{-- Use $contactMessage instead of $message --}}
            <p>Thank you for your patience. I've read your message about <strong>"{{ $contactMessage->subject }}"</strong> and wanted to respond.</p>
            
            <div class="reply-box">
                {{-- <h3>My Response:</h3> --}}
                {{-- Use $replyMessage instead of $reply --}}
                <p style="color: #2a332b; font-size: 16px; line-height: 1.8; white-space: pre-line;">{{ $replyMessage }}</p>
            </div>
            
            {{-- <div class="original-message">
                <span class="original-label">Your Original Message:</span> --}}
                {{-- Use $contactMessage instead of $message --}}
                {{-- <p style="margin: 0; white-space: pre-line;">{{ $contactMessage->message }}</p>
            </div> --}}
            
            <div class="signature">
                <div class="signature-name">Umesh Ghimire</div>
                <div class="signature-title">soil & code</div>
                <p style="color: #5a5f4b;">{{ config('app.url') }}</p>
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ config('app.url') }}" class="btn">Visit Portfolio</a>
            </div>
        </div>
        
        <div class="footer">
            <p style="margin: 0;">© {{ date('Y') }} {{ config('app.name') }} — growing digital roots</p>
            <p style="margin: 10px 0 0; font-size: 12px; opacity: 0.7;">This email was sent in response to your inquiry.</p>
        </div>
    </div>
</body>
</html>