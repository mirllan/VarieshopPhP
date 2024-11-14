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

# Variables para comparar y detectar nuevos usuarios
ultimo_usuario = None

try:
    while True:
        # Configuración de la conexión a la base de datos dentro del ciclo para refrescar los datos
        db = mysql.connector.connect(
            host="localhost",
            user="juan",
            password="1234",
            database="varishop",
            use_pure=True  
        )
        cursor = db.cursor(buffered=True)

        # Consulta el último usuario insertado y su rol en la tabla "cliente"
        cursor.execute("SELECT Nombre, rol FROM cliente ORDER BY id DESC LIMIT 1")
        resultado = cursor.fetchone()
        
        if resultado:
            usuario_actual, rol_actual = resultado
            print(f"Usuario consultado en la base de datos: {usuario_actual} | Rol: {rol_actual}")  # Mensaje de depuración
            
            # Verifica si el usuario actual es diferente al último usuario procesado
            if usuario_actual != ultimo_usuario:
                print(f"Nuevo usuario detectado: {usuario_actual} con rol: {rol_actual}")
                
                # Envía un mensaje MQTT con el nuevo usuario bajo el tópico "user"
                client.publish("user", usuario_actual, qos=1)
                print(f"Mensaje enviado a MQTT (user): {usuario_actual}")
                
                # Envía también el rol bajo el tópico "product"
                client.publish("product", rol_actual, qos=1)
                print(f"Mensaje enviado a MQTT (product): {rol_actual}")
                
                # Actualiza el último usuario procesado para evitar duplicados
                ultimo_usuario = usuario_actual

        # Cierra el cursor y la conexión para refrescar los datos en la siguiente consulta
        cursor.close()
        db.close()
        
        # Espera unos segundos antes de volver a consultar
        time.sleep(5)

except KeyboardInterrupt:
    print("Exiting")
    client.disconnect()
    client.loop_stop()
