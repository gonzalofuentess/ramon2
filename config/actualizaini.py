import configparser
import argparse

configuracion = configparser.ConfigParser()
configuracion.read('config.ini')

analizador = argparse.ArgumentParser(description='Tutorial sobre argparse.')
analizador.add_argument("-f", help="Setea la frecuencia.")
analizador.add_argument("-c", help="Setea el comentario.")
analizador.add_argument("-s", help="Setea el periodo de silencio.")
argumento = analizador.parse_args()


if argumento.f:
  print("Argumento opcional solicitado: -f")
  print("Argumento acompañado de:"+argumento.f)
  configuracion['Radio']['frecuencia'] = str(argumento.f)
if argumento.c:
    print("Argumento opcional solicitado: -c")
    print("Argumento acompañado de:" + argumento.c)
    configuracion['Radio']['comentario'] = str(argumento.c)
if argumento.s:
    print("Argumento opcional solicitado: -s")
    print("Argumento acompañado de:" + argumento.s)
    configuracion['Radio']['silencio'] = str(argumento.s)
else:
  print("Ningún argumento.")


#configuracion['Radio']['frecuencia'] = str(106.9)

with open('config.ini', 'w') as configfile:
    configuracion.write(configfile)


