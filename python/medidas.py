from sklearn.cluster import KMeans
import mysql.connector
import numpy as np


connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="topshop"
)


cursor = connection.cursor()


cursor.execute("SELECT idUsuario FROM inicios_sesion ORDER BY fechaHoraInicio DESC LIMIT 1")
result = cursor.fetchone()


if result:
    idUsuario = result[0]
    print(f"Último idUsuario de inicios_sesion: {idUsuario}")

    
    cursor.execute(f"SELECT idUsuario, altura, peso, busto, cintura, caderas FROM medidasusuario WHERE idUsuario = {idUsuario}")
    medidas_usuario = cursor.fetchone()

    
    cursor.execute("SELECT CodPrenda, altura, peso, busto, cintura, caderas FROM medidasPrenda")
    medidas_prenda = cursor.fetchall()

    
    medidas_usuario_array = np.array(medidas_usuario[1:])  
    
    medidas_prenda_array = np.array([list(prenda)[1:] for prenda in medidas_prenda])  

    
    medidas_comparacion = np.vstack([medidas_usuario_array, medidas_prenda_array])

    
    kmeans = KMeans(n_clusters=2, random_state=42)  
    kmeans.fit(medidas_comparacion)

    
    usuario_cluster = kmeans.predict([medidas_usuario_array])[0]
    print("El usuario pertenece al clúster:", usuario_cluster)

    
    cursor.execute("CREATE TABLE IF NOT EXISTS ClusterAssignments (CodPrenda INT, ClusterID INT)")

    
    for cod_prenda, cluster in zip([prenda[0] for prenda in medidas_prenda], kmeans.labels_):
        cursor.execute(f"INSERT INTO ClusterAssignments (CodPrenda, ClusterID) VALUES ({cod_prenda}, {cluster})")

    
    prendas_sugeridas = [cod_prenda for cod_prenda, cluster in zip([prenda[0] for prenda in medidas_prenda], kmeans.labels_) if cluster == usuario_cluster]

    print("Prendas sugeridas para el usuario:", prendas_sugeridas)

else:
    print("No se encontró ningún idUsuario en inicios_sesion")

# Cerrar la conexión
connection.commit()
connection.close()
