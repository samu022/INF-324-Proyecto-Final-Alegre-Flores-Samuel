from PIL import ImageTk, Image
import tkinter as tk
from tkinter import ttk
import sqlite3

# Nota database_ambientes.db cambiarlo a database.db si se desea
# analisis de texturas para paisajes y hogares

def load_textures():
    sqliteConnection = sqlite3.connect('database.db')
    cursor = sqliteConnection.cursor()

    lista = list()

    cursor.execute("SELECT DISTINCT nombre FROM textura")

    for textura in cursor.fetchall():
        lista.append(textura[0])
    return lista

def cambiar_color(imagen, color_original, color_nuevo):
    imagen = imagen.convert("RGB")  # Convertir la imagen a modo RGB
    pixels = imagen.load()
    ancho, alto = imagen.size
    
    # Iterar sobre los pixeles de la imagen
    for i in range(ancho):
        for j in range(alto):
            r, g, b = pixels[i, j]  # Obtener el valor RGB del píxel
            
            # Verificar si el color del píxel coincide con el color original
            if (r, g, b) == color_original:
                # Cambiar el color del píxel al color nuevo
                pixels[i, j] = color_nuevo
    
    return imagen

def upload_db():
    sqliteConnection = sqlite3.connect('database.db')
    cursor = sqliteConnection.cursor()
    name_texture = input_nombre_textura_cargar.get("1.0", tk.END).strip().lower()
    r = int(input_r.get("1.0", tk.END))
    g = int(input_g.get("1.0", tk.END))
    b = int(input_b.get("1.0", tk.END))

    print(name_texture, r, g, b)

    cursor.execute(f"INSERT INTO textura(nombre, r, g, b) VALUES ('{name_texture}', {r}, {g}, {b})")

    sqliteConnection.commit()

    cursor.close()

def obtener_info_pixel(event):

    input_r.delete("1.0", tk.END)
    input_g.delete("1.0", tk.END)
    input_b.delete("1.0", tk.END)

    x = event.x
    y = event.y
    
    pixel_rgb = rgb_data[x, y]
    r, g, b = pixel_rgb
    
    input_r.insert(tk.END, r)
    input_g.insert(tk.END, g)
    input_b.insert(tk.END, b)

    coordenadas_label.config(text=f"Coordenadas (x, y): {x}, {y}")
    rgb_label.config(text=f"Valores RGB: {r}, {g}, {b}")

    margen = 10

    sqliteConnection = sqlite3.connect('database.db')
    cursor = sqliteConnection.cursor()

    query = f"SELECT nombre FROM textura WHERE r BETWEEN {r} - {margen} AND {r} + {margen} AND g BETWEEN {g} - {margen} AND {g} + {margen} AND b BETWEEN {b} - {margen} AND {b} + {margen}"
    cursor.execute(query)

    resultado = cursor.fetchone()

    if resultado == None:
        resultado = "Ninguna"
    else:
        resultado = resultado[0]

    textura_label.config(text=f"Textura: {resultado}")

    cursor.close()

# Función para manejar la selección del ComboBox
def seleccionar_opcion():
    seleccion = opcion_seleccionada.get()

    r = int(input_r.get("1.0", tk.END))
    g = int(input_g.get("1.0", tk.END))
    b = int(input_b.get("1.0", tk.END))

    sqliteConnection = sqlite3.connect('database.db')
    cursor = sqliteConnection.cursor()

    cursor.execute(f"SELECT AVG(r), AVG(g), AVG(b) FROM textura WHERE nombre = '{seleccion}' GROUP BY nombre")
    res = cursor.fetchone()

    print(res[0], res[1], res[2])

    new_r = int(res[0])
    new_g = int(res[1])
    new_b = int(res[2])

    nueva_imagen = cambiar_color(image, (r, g, b), (new_r, new_g, new_b))

    imagen_tk = ImageTk.PhotoImage(nueva_imagen)

    label.config(image=imagen_tk)
    label.image = imagen_tk

    print("Opción seleccionada:", seleccion)

# Paso 1: Carga de la imagen
#image_path = 'imagen_prueba.jpg'
image_path = input("[+] Introduce directorio imagen: ")
image = Image.open(image_path)
#width, height = image.size
width, height = (400,300)
image = image.resize((400,300))
# Paso 2: Creación de la ventana de la aplicación
window = tk.Tk()
window.title("Visualizador de Imagen")
window.geometry(f"{width}x{height}")

# Paso 3: Mostrar la imagen en un widget Label
image_tk = ImageTk.PhotoImage(image)
label = tk.Label(window, image=image_tk)
label.pack()

# Paso 4: Obtener la información del pixel al hacer clic en la imagen
rgb_data = image.load()
label.bind("<Button-1>", obtener_info_pixel)

# Paso 5: Mostrar la información del pixel en etiquetas
coordenadas_label = tk.Label(window, text="Coordenadas (x, y):")
coordenadas_label.pack()

textura_label = tk.Label(window, text="Textura:")
textura_label.pack()

rgb_label = tk.Label(window, text="Valores RGB:")
rgb_label.pack()

label_nombre_textura_cargar = tk.Label(window, text="Introduce el nombre de la textura a cargar: ")
input_nombre_textura_cargar = tk.Text(window,
                                    height = 1,
                                    width = 10)
label_nombre_textura_cargar.pack()
input_nombre_textura_cargar.pack()

input_r = tk.Text(window,
                    height = 1,
                    width = 5)

input_g = tk.Text(window,
                    height = 1,
                    width = 5)

input_b = tk.Text(window,
                    height = 1,
                    width = 5)

label_r = tk.Label(window, text="R: ")
label_r.pack()
input_r.delete("1.0", tk.END)
input_r.pack()
label_g = tk.Label(window, text="G: ")
label_g.pack()
input_g.delete("1.0", tk.END)
input_g.pack()
label_b = tk.Label(window, text="B: ")
label_b.pack()
input_b.delete("1.0", tk.END)
input_b.pack()

load_button = tk.Button(window,
                        text = "Subir Textura a BD", 
                        command = upload_db)

load_button.pack()

opciones = load_textures()

# Variable para almacenar la selección del ComboBox
opcion_seleccionada = tk.StringVar()

# Crear el ComboBox
combobox = ttk.Combobox(window, textvariable=opcion_seleccionada, values=opciones)
combobox.pack()

# Configurar la opción predeterminada
opcion_seleccionada.set(opciones[0])

# Asociar la función de manejo de eventos al ComboBox
#combobox.bind("<<ComboboxSelected>>", seleccionar_opcion)

change_button = tk.Button(window,
                        text = "Cambio Textura", 
                        command = seleccionar_opcion)

change_button.pack()

# Paso 6: Iniciar el bucle principal de la aplicación
window.mainloop()
