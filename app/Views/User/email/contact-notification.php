<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Message Received</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f6fb; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f3f6fb; padding:30px 15px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:680px; background-color:#ffffff; border-radius:12px; overflow:hidden;">
          <tr>
            <td style="background:linear-gradient(135deg, #0b63ce 0%, #12a4d9 100%); padding:32px 36px; color:#ffffff;">
              <div style="font-size:12px; letter-spacing:1.2px; text-transform:uppercase; opacity:0.85;">TheITUpdates</div>
              <h1 style="margin:10px 0 0; font-size:28px; line-height:1.3; font-weight:700;">You received a new message</h1>
              <p style="margin:12px 0 0; font-size:15px; line-height:1.7; opacity:0.95;">Someone reached out through the contact form on your website. Their details are below for quick review.</p>
            </td>
          </tr>
          <tr>
            <td style="padding:24px 36px 0;">
              <div style="padding:18px 20px; background-color:#eef6ff; border:1px solid #d7e8ff; border-radius:10px; font-size:14px; line-height:1.7; color:#234166;">
                You can reply directly to this email to respond to <strong><?= esc($contact['name']) ?></strong>.
              </div>
            </td>
          </tr>
          <tr>
            <td style="padding:32px 36px 12px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;">
                <tr>
                  <td style="padding:0 0 18px; font-size:14px; color:#6b7280; width:160px;">Received On</td>
                  <td style="padding:0 0 18px; font-size:15px; color:#111827; font-weight:600;"><?= esc($submittedAt) ?></td>
                </tr>
                <tr>
                  <td style="padding:0 0 18px; font-size:14px; color:#6b7280; width:160px;">Name</td>
                  <td style="padding:0 0 18px; font-size:15px; color:#111827; font-weight:600;"><?= esc($contact['name']) ?></td>
                </tr>
                <tr>
                  <td style="padding:0 0 18px; font-size:14px; color:#6b7280;">Email</td>
                  <td style="padding:0 0 18px; font-size:15px; color:#111827; font-weight:600;"><?= esc($contact['email']) ?></td>
                </tr>
                <tr>
                  <td style="padding:0 0 18px; font-size:14px; color:#6b7280;">Company</td>
                  <td style="padding:0 0 18px; font-size:15px; color:#111827; font-weight:600;"><?= esc($contact['company']) ?></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:0 36px 32px;">
              <div style="padding:24px; background-color:#f8fafc; border:1px solid #e5e7eb; border-radius:10px;">
                <div style="font-size:14px; color:#6b7280; margin-bottom:10px;">Message</div>
                <div style="font-size:15px; line-height:1.8; color:#111827;"><?= nl2br(esc($contact['message'])) ?></div>
              </div>
            </td>
          </tr>
          <tr>
            <td style="padding:0 36px 36px;">
              <div style="font-size:13px; line-height:1.7; color:#6b7280; border-top:1px solid #e5e7eb; padding-top:20px;">
                This message was sent from the TheITUpdates contact page.
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>