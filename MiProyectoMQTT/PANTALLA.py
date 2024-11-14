import paho.mqtt.client as mqttClient
import time

def on_connect(client, userdata, flags, rc):

    if rc == 0:

        print("Connected to broker")

        global Connected                #Use global variable
        Connected = True                #Signal connection

    else:

        print("Connection failed")

def on_message(client, userdata, message):
    print ("Message received: "  + str(message.payload))

Connected = False   #global variable for the state of the connection


client = mqttClient.Client()
client.on_connect= on_connect                      #attach function to callback
client.on_message= on_message                      #attach function to callback

client.connect("broker.mqtt.cool", 1883, 60)

client.loop_start()        #start the loop

while Connected != True:    #Wait for connection
    time.sleep(0.1)

client.subscribe("acknowledge")

user=''
product=''

try:
    while True:
        user=input("ingrese un usuario: ")
        client.publish("user", user, qos=1)
        product=input("ingrese un producto: ")
        client.publish("product", product, qos=1)
        time.sleep(1)

except KeyboardInterrupt:
    print ("exiting")
    client.disconnect()
    client.loop_stop()