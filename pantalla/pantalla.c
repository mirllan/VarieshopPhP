
using System;
using System.Text;
using System.Threading.Tasks;
using MQTTnet;
using MQTTnet.Client;
using MQTTnet.Client.Options;

class Program
{
    static async Task Main(string[] args)
    {
        // Dirección del broker MQTT
        string broker = "broker.mqtt.cool";
        int port = 1883;
        string topic = "test/topic";
        string messageContent = "Hola desde C#";

        // Crear un cliente MQTT
        var factory = new MqttFactory();
        var mqttClient = factory.CreateMqttClient();

        // Configurar opciones de conexión
        var options = new MqttClientOptionsBuilder()
            .WithTcpServer(broker, port)  // Dirección y puerto del broker
            .WithCleanSession()
            .Build();

        try
        {
            // Conectar al broker
            await mqttClient.ConnectAsync(options);
            Console.WriteLine("Conectado al broker MQTT");

            // Crear un mensaje
            var message = new MqttApplicationMessageBuilder()
                .WithTopic(topic)
                .WithPayload(messageContent)
                .Build();

            // Publicar el mensaje
            await mqttClient.PublishAsync(message);
            Console.WriteLine($"Mensaje publicado: {messageContent}");

            // Desconectar
            await mqttClient.DisconnectAsync();
            Console.WriteLine("Desconectado del broker");
        }
        catch (Exception ex)
        {
            Console.WriteLine($"Error: {ex.Message}");
        }
    }
}
