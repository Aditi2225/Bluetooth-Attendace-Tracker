import http.server
import socketserver
import json

PORT = 8001

class Handler(http.server.SimpleHTTPRequestHandler):
    def do_GET(self):
        if self.path == '/get_mac_address':
            mac_address = self.get_bluetooth_mac_address()
            response = {'mac_address': mac_address}
            self.send_response(200)
            self.send_header('Content-type', 'application/json')
            self.send_header('Access-Control-Allow-Origin', '*')
            self.end_headers()
            self.wfile.write(json.dumps(response).encode('utf-8'))
            print("Response sent to client:", response)
        else:
            self.send_response(404)
            self.end_headers()

    def get_bluetooth_mac_address(self):
        try:
            import wmi
            mac_addresses = []
            wmi_obj = wmi.WMI()
            for adapter in wmi_obj.Win32_NetworkAdapter():
                if adapter.NetConnectionID and 'Bluetooth' in adapter.NetConnectionID:
                    mac_addresses.append(adapter.MACAddress)
            return mac_addresses[0] if mac_addresses else None
        except Exception as e:
            print(f"Error: {e}")
            return None

Handler.extensions_map.update({
    ".html": "text/html",
})

with socketserver.TCPServer(("", PORT), Handler) as httpd:
    print(f"Serving at port {PORT}")
    httpd.serve_forever()