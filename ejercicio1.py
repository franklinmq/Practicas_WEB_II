hora = ["01:30"] # Definimos una lista con la hora espejo de ejemplo

for i in range(len(hora)): # Recorremos la lista de horas usando un índice
    horaEspejo = hora[i] # Obtenemos la hora actual del ciclo
    
    # Separar hora y minutos
    partes = horaEspejo.split(':') # Dividimos el texto por los dos puntos para separar hora y minutos
    h = int(partes[0]) # Convertimos la parte de la hora a entero
    m = int(partes[1]) # Convertimos la parte de los minutos a entero

    # Calcular hora real
    hReal = 12 - h # Restamos la hora espejo de 12 para obtener la hora real
    if hReal == 0: # Si la resta da 0 (es decir, eran las 12)
        hReal = 12 # Ajustamos la hora real a las 12

    # Calcular minutos reales
    mReal = 60 - m # Restamos los minutos espejo de 60 para obtener los minutos reales
    if mReal == 60: # Si la resta da 60 (es decir, eran las en punto :00)
        mReal = 0 # Ajustamos los minutos reales a 0

    # Agregar cero a la izquierda si hace falta
    hRealStr = str(hReal) # Convertimos la hora real calculada a texto
    if hReal < 10: # Si la hora es menor a 10 (un solo dígito)
        hRealStr = "0" + hRealStr # Le agregamos un "0" al principio

    mRealStr = str(mReal) # Convertimos los minutos reales calculados a texto
    if mReal < 10: # Si los minutos son menores a 10 (un solo dígito)
        mRealStr = "0" + mRealStr # Le agregamos un "0" al principio

    print(f"Espejo: {horaEspejo} -- Hora real: {hRealStr}:{mRealStr}") # Imprimimos el resultado formateado
