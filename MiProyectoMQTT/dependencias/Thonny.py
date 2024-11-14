
from machine import Pin, I2C
import librerias
import time
import network
import ubinascii
import machine
import urequests  # Necesitarás la biblioteca urequests para realizar solicitudes HTTP
from umqttsimple import MQTTClient
''''''
import _thread
# Configura tus credenciales Wi-Fi
ssid = 'YolandaPottes'
password = 'yolandapottesJD*'

# Token de autorización y configuración del servidor
token = "Bearer EAAIao2QuMP4BAEg4Hs76IvHZAeBuZCYP9lCnipU1hlxDmTcw77orMZCaawAoAusMNvvDlETU5d1uxiwjvB72j2DW6UOJqxIxZCofP6apbuitVtZBjueB4HZBXZBhIY64JN75tWFVY1UQbBo9gZAZBWl776gC3khAPcgO4tiykQ1CPpZBXTBCEeRZB49dSUgZB2rYW2OYr7NWKgzEIgZDZD"
servidor = "https://graph.facebook.com/v16.0/111290641852610/messages"
payload = '{"messaging_product":"whatsapp","to":"527121122441","type":"text","text": {"body": "Movimiento detectado"}}'


# Información broker

mqtt_server = 'broker.mqtt.cool'
mqtt_port = 1883
#EXAMPLE IP ADDRESS
#mqtt_server = '192.168.1.144'
client_id = ubinascii.hexlify(machine.unique_id())
topic_sub = b'user'
topic_sub2 = b'product'
topic_pub = b'acknowledge'

usuario=''
producto=''

# Conectar a Wi-Fi
def conectar_wifi():
    wlan = network.WLAN(network.STA_IF)
    wlan.active(True)
    wlan.connect(ssid, password)

    print("Conectando a Wi-Fi...")
    while not wlan.isconnected():
        time.sleep(0.5)
        print(".")

    print("Conectado al Wi-Fi con IP:", wlan.ifconfig()[0])
    return wlan  # Devuelve la instancia de WLAN para usarla después

# Inicializa el I2C para el display OLED
def inicializar_display():
    i2c = I2C(0, sda=Pin(21), scl=Pin(22))
    print('Escaneando bus I2C...')
    devices = i2c.scan()

    if len(devices) == 0:
        print("¡No se encontró ningún dispositivo I2C!")
        return None
    else:
        print('Dispositivos I2C encontrados:', len(devices))
        for device in devices:  
            print("Dirección decimal: ", device, " | Dirección hexadecimal: ", hex(device))

    # Inicializa el display OLED
    display = librerias.SSD1306_I2C(128, 64, i2c)
    return display



def sub_cb(topic, msg):
  global usuario,producto
  print((topic, msg))
  if topic == b'user':
      usuario=msg.decode("utf-8")
  if topic == b'product':
      producto=msg.decode("utf-8")


def connect_and_subscribe():
  global client_id, mqtt_server, topic_sub
  client = MQTTClient(client_id, mqtt_server,port=mqtt_port,keepalive=60)
  client.set_callback(sub_cb)
  client.connect()
  client.subscribe(topic_sub)
  client.subscribe(topic_sub2)
  print('Connected to %s MQTT broker, subscribed to %s topic' % (mqtt_server, topic_sub))
  return client

def restart_and_reconnect():
  print('Failed to connect to MQTT broker. Reconnecting...')
  time.sleep(10)
  machine.reset()



wlan = conectar_wifi()
display = inicializar_display()



# Función principal
def rutina_pantalla():
    
    global usuario,producto

    

    
    if display is None:
        return  # Termina si no se pudo inicializar el display
    
    while True:
        if wlan.isconnected():
            try:
                
                 
                '''
                headers = {
                    "Content-Type": "application/json",
                    "Authorization": token
                }
                response = urequests.post(servidor, data=payload, headers=headers)
                
                print("Código de respuesta HTTP:", response.status_code)
                print("Respuesta:", response.text)
                '''
                max_length = 6  # Número máximo de caracteres que caben en la pantalla
                usuario_corto = usuario[:max_length]  # Limitar el texto a la longitud máxima
                display.text('Usuario:{}'.format(usuario), 5, 28, 1)
                display.rect (2, 2, 125, 60, 1)
                display.show()
                display.fill(0)
                time.sleep(3)
                
                display.text('Rol:{}'.format(producto), 5, 28, 1)
                display.rect  (2, 2, 125, 60, 1)
                display.show()
                display.fill(0)
                time.sleep(3)
                

                # Mover el texto de derecha a izquierda
                for x in range(128, -201, -1):  # Desde 128 hasta -200
              
                    display.text('BIENVENIDO A VARIESHOP', x, 28, 1)  # Cambia la posición x
                    display.invert(0)  # Cambiar color de pantalla (en este caso, mantener el color normal)
                    display.show()  # Muestra el texto en la pantalla
                    display.fill(0) 
                    if x > -170:  # Mostrar línea hasta que el texto se esconda
                        display.hline(0, 10, 128, 1)  # Línea horizontal superior
                        display.hline(0, 54, 128, 1)  # Línea horizontal inferior
                    else:
                        display.fill(0)  # Limpia la pantalla si el texto está completamente oculto
                    
                    
            
            except Exception as e:
                print("Error al realizar la solicitud:", e)
            
            time.sleep(10)  # Esperar 10 segundos antes de volver a enviar
        else:
            print("Wi-Fi desconectado")
            time.sleep(5)  # Esperar antes de volver a intentar

# Iniciar el programa
_thread.start_new_thread(rutina_pantalla,())




        
try:
        if wlan.isconnected():
            client = connect_and_subscribe()
except OSError as e:
        restart_and_reconnect()

while True:
    client.check_msg()
    client.publish(topic_pub, b'hola')
    time.sleep(1)







