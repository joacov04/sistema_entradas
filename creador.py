import qrcode
import mysql.connector
import string
import random
import sys
from PIL import Image

conn = mysql.connector.connect(host='localhost', database='entradas', user='fdp', password='fiestadelpolitecnico', auth_plugin='mysql_native_password')
cursor = conn.cursor()

insertarEntrada = ("INSERT INTO fdp "
        "(token, nombre, usada) "
        "VALUES (%s, %s, %s)")

def overlay(img_path):
    background = Image.open('back.png')
    img1 = Image.open(img_path)
    img1.paste(background, (0,0), mask=background)
    img1.save(img_path)


def makeQR(token, nombre):
    qr = qrcode.QRCode(version=1, box_size=10, border=1)
    qr.add_data('https://jva.com.ar/entradas/lector.php?lector='+token)
    qr.make(fit=True)
    img = qr.make_image(fill='black', back_color='white')
    img_name = nombre.replace(' ', '_')
    img.save('qr/'+img_name+'.png')

def tokenAndSave(name:str):

    letters = string.ascii_uppercase
    tok = ''.join(random.choice(letters) for _ in range(15))


    cursor.execute("SELECT * FROM fdp WHERE token='%s'"%tok)
    if cursor.rowcount > 0:
        cursor.close()
        tokenAndSave(name)
    else: 
        cursor.fetchall()
        entradaDatos = (tok, name.replace('_', ' '), "0")
        cursor.execute(insertarEntrada, entradaDatos)
        conn.commit()
        cursor.close()
        makeQR(tok, name)

tokenAndSave(sys.argv[1])

conn.close()
#for(token, nombre, usada) in cursor:
#    print(token, type(token))
#    print(f'{token} nombre:{nombre}, usada:{usada}')
