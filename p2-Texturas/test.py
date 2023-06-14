import sqlite3

# Conectar a la base de datos
conexion = sqlite3.connect("database.db")
cursor = conexion.cursor()

# Valores RGB y margen de tolerancia
r = 32
g = 77
b = 82
margen = 10

# Consulta para encontrar la textura correspondiente dentro del margen de tolerancia
consulta = "SELECT nombre FROM textura WHERE r BETWEEN ? - ? AND ? + ? AND g BETWEEN ? - ? AND ? + ? AND b BETWEEN ? - ? AND ? + ?"
valores = (r, margen, r, margen, g, margen, g, margen, b, margen, b, margen)
cursor.execute(consulta, valores)

# Obtener los resultados de la consulta
resultado = cursor.fetchone()

# Mostrar el resultado
if resultado:
    print("Se encontró una textura dentro del margen de tolerancia.")
    print("La textura correspondiente es: {}".format(resultado[0]))
else:
    print("No se encontró ninguna textura dentro del margen de tolerancia.")

# Cerrar la conexión a la base de datos
conexion.close()


