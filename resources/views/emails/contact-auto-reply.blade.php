<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for reaching out</title>
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
        .message-box {
            background: rgba(193, 123, 92, 0.05);
            border: 1px solid #eac5b0;
            border-radius: 60px 20px 60px 20px;
            padding: 30px;
            margin: 30px 0;
        }
        .commitment {
            background: #e3dbcf;
            border-radius: 40px 12px 40px 12px;
            padding: 20px;
            margin: 30px 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .commitment i {
            font-size: 30px;
            color: #c17b5c;
        }
        .footer {
            background: #2a4230;
            color: #e3dbcf;
            padding: 30px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background: #c17b5c;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 60px 20px 60px 20px;
            font-weight: 600;
        }
        .btn:hover {
            background: #4c6b4a;
        }
        .signature {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px dashed #eac5b0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">🌱 Seed Planted</h1>
            <p style="margin: 10px 0 0; opacity: 0.9;">Thank you for reaching out</p>
        </div>
        
        <div class="content">
            <div class="greeting">
                <p>Dear <strong>{{ $message->name }}</strong>,</p>
            </div>
            
            <p>Thank you for reaching out to me regarding <strong>"{{ $message->subject }}"</strong>. Your message has been received and carefully noted.</p>
            
            <div class="message-box">
                <h3 style="color: #2a4230; margin-top: 0;">Your Message:</h3>
                <p style="color: #2a332b;">{{ $message->message }}</p>
            </div>
            
            <div class="commitment">
                <i class="fas fa-moon">🌙</i>
                <div>
                    <strong style="color: #2a4230; display: block; margin-bottom: 5px;">One Moon Cycle Guarantee</strong>
                    <p style="margin: 0; color: #2a332b;">I read every message with care and will reply within a moon cycle. Your words matter to me.</p>
                </div>
            </div>
            
            <p style="font-style: italic; color: #5a5f4b; text-align: center;">
                "The best time to plant a tree was 20 years ago. The second best time is now."
            </p>
            
            <div class="signature">
                <p style="margin: 0;"><strong>Umesh Ghimire</strong></p>
                <p style="margin: 5px 0 0; color: #c17b5c;">soil & code</p>
                <p style="margin: 10px 0 0; font-size: 12px; color: #8a9d8a;">{{ config('app.url') }}</p>
            </div>
        </div>
        
        <div class="footer">
            <p style="margin: 0; font-size: 14px;">© {{ date('Y') }} {{ config('app.name') }} — growing digital roots</p>
        </div>
    </div>
</body>
</html>