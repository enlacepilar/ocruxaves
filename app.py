from flask import Flask, url_for,render_template, request, abort
import sqlite3
app= Flask (__name__)

##con = sqlite3.connect ("ocrux")
##print ("Abro base de datos...")


### webs  - PAGINA PRINCIPAL ###
@app.route('/')
def index():
## Para pasarle datos al html
##    templateData = {
##          'titulo' : 'Hola Mundo',
##          'numero' : 5
##       }
    
    return render_template ("index.html")#, **templateData)


##### BUSQUEDA ************************



@app.route('/buscando', methods=['POST', 'GET'])

def buscar():
    con = sqlite3.connect("ocrux")  
    con.row_factory = sqlite3.Row  
    cur = con.cursor()

    
    año = request.form["año"]
    genero = request.form["genero"]
    titulo= request.form["titulo"]
    autor= request.form["autor"]
    ## Esto anda - no borrar
    cur.execute("select * from libros where año LIKE '%"+año+"%' and titulo like '%"+titulo+"%' and genero LIKE '%"+genero+"%' and autor LIKE '%"+autor+"%'")  
    rows = cur.fetchall() 
    return render_template("resultado.html",rows = rows)
    # NO borrar ----------








### WEBs OCULTAS QUE NO ESTAN EN LA BARRA ****************

@app.route('/busca_libros')
def busca_libros():
    return render_template ("busca_libros.html")




@app.route('/agrega_libro')
def agrega_libro():
    return render_template ("agrega_libro.html")

@app.route ("/guardar" , methods=['POST', 'GET'])
def guardar():
    msg = "Datos Guardados"
    if request.method== "POST":
        try:
            con = sqlite3.connect ("ocrux")
            cur=con.cursor()
            ant=("")# acá voy a almacenar el ultimo ID
            datos = cur.execute(" SELECT * FROM libros WHERE ID = (SELECT MAX(ID) FROM libros);")

            for i in datos:
                ant=i[0]

            id1=ant+1 #al id le sumo 1 de la variable "ant"

            año = request.form["año"]
            titulo = request.form["titulo"]
            genero = request.form["genero"]
            autor= request.form["autor"]
            com = request.form["com"]

            con.execute("INSERT INTO libros(id,año,titulo,genero,autor,comentario) VALUES (?,?,?,?,?,?)",(id1, año,titulo,genero,autor,com))

##            print ("datos cargados")   
            con.commit()

        except:
            con.rollback()
            msg= "No se pudo agregar libro"
        finally:
            return render_template ("exito.html", msg=msg)




@app.route('/ver_libros') # Todos los libros
def ver_libros():
    con = sqlite3.connect("ocrux")  
    con.row_factory = sqlite3.Row  
    cur = con.cursor()
    cur.execute("select * from libros")  
    rows = cur.fetchall()  

    return render_template("ver_libros.html",rows = rows) 



@app.route('/borra_libro')

def borra_libro(): 
    return render_template ("borra_libro.html")


@app.route('/borrar', methods=['POST', 'GET'])
def borrar():
    con = sqlite3.connect("ocrux")  
    con.row_factory = sqlite3.Row  
    cur = con.cursor()

    
    año = request.form["año"]
    genero = request.form["genero"]
    titulo= request.form["titulo"]
    autor= request.form["autor"]
    ## Esto anda - no borrar
    cur.execute("select * from libros where año LIKE '%"+año+"%' and titulo like '%"+titulo+"%' and genero LIKE '%"+genero+"%' and autor LIKE '%"+autor+"%'")  
    rows = cur.fetchall() 
    return render_template("busqueda_para_borrar.html",rows = rows)
    # NO borrar ----------

@app.route('/borrado', methods=['POST', 'GET'])
def borrado():
    msg = ""
    try:
        con = sqlite3.connect("ocrux")  
        cur = con.cursor()
        id1 = request.form["id1"]

        ## Esto anda
        cur.execute('DELETE FROM libros WHERE id ='+id1)  
        con.commit()
        msg = "Se Borró"
    except:
        con.rollback()
        msg = "Algo Pasó"
    finally:
        return render_template("borrado.html", msg = msg)
    
    # NO borrar ----------



if __name__ == '__main__':
    app.run(host= '0.0.0.0', port=5000, debug=False)
