"""
Generates a QR Code with the name and seller specified in argv[]

"""
import string
import random
import sys
import re
import qrcode
import mysql.connector
from PIL import Image
from PIL import ImageDraw
from PIL import ImageFont
# to do de aca
# que se pueda usar cualquier foto en vez de solo la que se llama back.png
IMG_PATH = 'app/vol3.png'

with open("app/credentials.inc", "r", encoding='ascii') as connection_file:
    credentials = {"user": "", "pass": "", "base": "", "host": "", "table": ""}
    for word in connection_file:
        for key in credentials:
            if re.search(key, word):
                if "'" in word:
                    credentials[key] = word.split("'")[1]
                else:
                    credentials[key] = word.split("\"")[1]


conn = mysql.connector.connect(
        host=credentials["host"],
        database=credentials["base"],
        user=credentials["user"],
        password=credentials["pass"],
        auth_plugin='mysql_native_password')

cursor = conn.cursor()

INSERTAR_ENTRADA = ("INSERT INTO "+credentials["table"]+" "
                    "(token, nombre, usada, vendedor) "
                    "VALUES (%s, %s, %s, %s)")


def overlay(qr_path, token):
    """
    Pastes the QR specified into the background image, with the token below.
    """
    font = ImageFont.truetype(font='app/Calibri.ttf', size=45)
    background = Image.open(IMG_PATH)
    (background_width, background_heigth) = background.size

    qr_img = Image.open(qr_path)
    (qr_width, qr_heigth) = qr_img.size
    heigth_to_paste = int(background_heigth/2.6)
    width_to_paste = int((background_width-qr_width)/2)

    background.paste(qr_img, (width_to_paste, heigth_to_paste))
    draw_object = ImageDraw.Draw(background)
    text_width = draw_object.textlength(token, font=font)
    draw_object.text(
            ((background_width-text_width)/2, heigth_to_paste+qr_heigth+4),
            token, font=font)

    background.save(qr_path)


def make_qr(token, nombre):
    """
    Makes the QR code with the specified token and saves it as the person name.
    """
    qr = qrcode.QRCode(version=1, box_size=25, border=1)
    qr.add_data(token)
    qr.make(fit=True)
    img = qr.make_image(fill='black', back_color='white')
    img_name = nombre.replace(' ', '_')
    img.save('qr/'+img_name+'.png')


def token_and_save(name: str, seller: str):
    """
    Generates the token and calls all the functions
    """

    letters = string.ascii_uppercase
    tok = ''.join(random.choice(letters) for _ in range(15))

    cursor.execute("SELECT * FROM "+credentials["table"]+" WHERE token='%s'" % tok)
    if cursor.rowcount > 0:
        cursor.close()
        token_and_save(name, seller)
    else:
        cursor.fetchall()
        entrada_datos = (tok, name.replace('_', ' '), "0", seller)
        cursor.execute(INSERTAR_ENTRADA, entrada_datos)
        conn.commit()
        cursor.close()
        make_qr(tok, name)
        overlay('qr/'+name+'.png', tok)


token_and_save(sys.argv[1], sys.argv[2])

conn.close()
# for(token, nombre, usada) in cursor:
#    print(token, type(token))
#    print(f'{token} nombre:{nombre}, usada:{usada}')
