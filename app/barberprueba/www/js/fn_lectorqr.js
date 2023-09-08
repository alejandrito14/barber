function scanQRCode() {
    cordova.plugins.qrscanner.scan(
        function (result) {
            // Éxito: result.text contiene el contenido del código QR escaneado
            document.getElementById('result').textContent = 'Contenido del código QR: ' + result.text;
        },
        function (error) {
            // Error: manejar el error aquí
            console.error('Error al escanear el código QR: ' + error);
        }
    );
}