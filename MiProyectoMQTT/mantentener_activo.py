import subprocess
import time
import mysql.connector
import sys
# Conexión a la base de datos MySQL
db = mysql.connector.connect(
    host="localhost",
    user="juan",
    password="1234",
    database="varishop",
)
cursor = db.cursor()

# Almacena el último ID de usuario detectado
ultimo_id = 0

try:
    while True:
        # Consulta el último usuario insertado
        cursor.execute("SELECT id, Nombre_usuario FROM usuarios ORDER BY id DESC LIMIT 1")
        resultado = cursor.fetchone()

        if resultado:
            actual_id, usuario = resultado
            # Verifica si hay un nuevo usuario insertado
            if actual_id != ultimo_id:
                print(f"Nuevo usuario detectado: {usuario}")
                print(sys.executable)
                # Ejecuta el script de pantalla.py cuando se detecta un nuevo usuario
                subprocess.Popen([sys.executable, "MiProyectoMQTT/pantalla.py"])

                # Actualiza el último ID para no procesarlo nuevamente
                ultimo_id = actual_id

        # Espera unos segundos antes de volver a consultar
        time.sleep(5)

except KeyboardInterrupt:
    cursor.close()
    db.close()
    print("Cerrando el programa")