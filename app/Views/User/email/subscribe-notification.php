<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Newsletter Subscription</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f6fb; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f3f6fb; padding:30px 15px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:680px; background-color:#ffffff; border-radius:12px; overflow:hidden;">
          <tr>
            <td style="background:linear-gradient(135deg, #0b63ce 0%, #12a4d9 100%); padding:32px 36px; color:#ffffff;">
              <div style="font-size:12px; letter-spacing:1.2px; text-transform:uppercase; opacity:0.85;">TheITUpdates</div>
              <h1 style="margin:10px 0 0; font-size:28px; line-height:1.3; font-weight:700;">New Newsletter Subscription</h1>
              <p style="margin:12px 0 0; font-size:15px; line-height:1.7; opacity:0.95;">A new user subscribed to your newsletter from the website footer form.</p>
            </td>
          </tr>
          <tr>
            <td style="padding:32px 36px 12px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;">
                <tr>
                  <td style="padding:0 0 18px; font-size:14px; color:#6b7280; width:160px;">Subscribed On</td>
                  <td style="padding:0 0 18px; font-size:15px; color:#111827; font-weight:600;"><?= esc($submittedAt) ?></td>
                </tr>
                <tr>
                  <td style="padding:0 0 18px; font-size:14px; color:#6b7280;">Email</td>
                  <td style="padding:0 0 18px; font-size:15px; color:#111827; font-weight:600;"><?= esc($subscription['email']) ?></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:0 36px 36px;">
              <div style="font-size:13px; line-height:1.7; color:#6b7280; border-top:1px solid #e5e7eb; padding-top:20px;">
                This subscription was captured through the TheITUpdates footer newsletter form.
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
