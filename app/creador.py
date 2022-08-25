import string
import random
import sys
import qrcode
import mysql.connector
from PIL import Image
from PIL import ImageDraw
from PIL import ImageFont
# to do de aca
# agarrar datos de la db desde el connect o desde un .env
# cambiar la funcion overlay para que funcione con cualquier resolucion
# que se pueda usar cualquier foto en vez de solo la que se llama back.png

conn = mysql.connector.connect(host='localhost', database='entradas', user='fdp', password='fiestadelpolitecnico', auth_plugin='mysql_native_password')
cursor = conn.cursor()

insertarEntrada = ("INSERT INTO fdp "
        "(token, nombre, usada) "
        "VALUES (%s, %s, %s)")

def overlay(img_path, token):
    font = ImageFont.truetype(font='app/Calibri.ttf', size=35)
    background = Image.open('app/back.png')
    (W, H) = background.size
    img1 = Image.open(img_path)
    (qr_width, qr_heigth) = img1.size
    heigth_to_paste = int(H/2)
    width_to_paste = int((W-qr_width)/2)
    background.paste(img1, (width_to_paste, heigth_to_paste))
    i1 = ImageDraw.Draw(background)
    w = i1.textlength(token, font=font)
    i1.text(((W-w)/2, heigth_to_paste+qr_heigth+2), token, font=font)
    background.save(img_path)


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
        overlay('qr/'+name+'.png', tok)

tokenAndSave(sys.argv[1])

conn.close()
#for(token, nombre, usada) in cursor:
#    print(token, type(token))
#    print(f'{token} nombre:{nombre}, usada:{usada}')
