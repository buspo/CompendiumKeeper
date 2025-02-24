<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; background-color: #f8f9fa;">
    <div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <!-- Logo Container -->
        <div style="background-color: #0056b3; padding: 20px; text-align: center; border-radius: 8px; margin: 20px;">
            <img src="https://raw.githubusercontent.com/buspo/CompendiumKeeper/refs/heads/main/public/CompendiumKeeper_extend.png" 
                 alt="Compendium Keeper" 
                 style="max-height: 40px; width: auto;">
        </div>
        
        <!-- Content -->
        <div style="padding: 20px; background-color: #ffffff;">
            <h2 style="color: #333333; margin-bottom: 20px;">Ciao {{ $name }},</h2>
            <p style="color: #666666; margin-bottom: 20px;">Grazie per esserti registrato a Compendium Keeper. Per completare la registrazione, verifica il tuo indirizzo email cliccando sul pulsante qui sotto:</p>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $url }}" 
                   style="display: inline-block; padding: 12px 24px; background-color: #003366; color: #ffffff; text-decoration: none; border-radius: 4px; font-weight: bold;">
                    Verifica Email
                </a>
            </div>

            <p style="color: #666666; margin-bottom: 20px;">Se non hai creato tu questo account, puoi ignorare questa email.</p>
        </div>

        <!-- Footer -->
        <div style="padding: 20px; text-align: center; font-size: 14px; color: #6c757d; border-top: 1px solid #e9ecef;">
            © 2024 Compendium Keeper.
        </div>
    </div>
</body>
</html>