<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invitation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 30px;">
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ url('storage/images/logo.png') }}" alt="HNVS Logo" style="max-width: 150px;">
    </div>
    <table width="100%" style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 6px; padding: 30px;">
        <tr>
            <td>
                <h4 style="margin-bottom: 20px; color: #2c3e50; text-align: center">Hi {{ $name }}!,</h4>
                <p style="font-size: 14px; color: #2c3e50; line-height: 1.6;">
                    We hope this message finds you well. You are formally invited to access your account or complete the required action by clicking the button below.
                </p>

                <p style="font-size: 14px; color: #2c3e50; line-height: 1.6;">
                    Kindly proceed by clicking the button to continue.
                </p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ $link }}" style="background-color: #007bff; color: #fff; padding: 12px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
                        Proceed Now
                    </a>
                </div>

                <p style="font-size: 14px; color: #2c3e50; line-height: 1.6;">
                    For your security, the reset password link expires after 48 hours. After that, please contact your administrator for your password.
                </p>

                <p style="font-size: 14px;">
                    <h5 style="margin-bottom: 0">Regards,</h5> <br>
                    <h5 style="margin-top: 0">Hilongos National Vocational School</h5>
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
