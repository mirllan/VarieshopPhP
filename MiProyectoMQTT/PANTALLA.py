import paho.mqtt.client as mqttClient
import mysql.connector
import time

# Funciones de MQTT
def on_connect(client, userdata, flags, rc):
    if rc == 0:
        print("Connected to broker")
        global Connected
        Connected = True
    else:
        print("Connection failed")

def on_message(client, userdata, message):
    print("Message received: " + str(message.payload))

# Configuración de MQTT
Connected = False
client = mqttClient.Client()
client.on_connect = on_connect
client.on_message = on_message
client.connect("broker.mqtt.cool", 1883, 60)
client.loop_start()

# Configuración de la conexión a la base de datos
db = mysql.connector.connect(
    host="localhost",
    user="juan",
    password="1234",
    database="varishop",
    use_pure=True  
)

cursor = db.cursor()

# Variables para comparar y detectar nuevos usuarios
ultimo_usuario = None  # Usamos una variable para almacenar el último usuario procesado

try:
    while True:
        # Consulta la columna "Nombre_usuario" de la tabla "usuarios"
        cursor.execute("SELECT Nombre_usuario FROM usuarios ORDER BY id DESC LIMIT 1")
        resultado = cursor.fetchone()
        
        if resultado:
            usuario_actual = resultado[0]
            
            # Verifica si el usuario actual es diferente al último usuario procesado
            if usuario_actual != ultimo_usuario:
                print(f"Nuevo usuario detectado: {usuario_actual}")
                
                # Envía un mensaje MQTT con el nuevo usuario
                client.publish("user", usuario_actual, qos=1)
                
                # Actualiza el último usuario procesado
                ultimo_usuario = usuario_actual
        
        # Espera unos segundos antes de volver a consultar
        time.sleep(5)

except KeyboardInterrupt:
    print("Exiting")
    client.disconnect()
    client.loop_stop()
    cursor.close()
    db.close()