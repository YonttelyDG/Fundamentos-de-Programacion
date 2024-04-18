def convertir_divisa(monto, divisa_origen, divisa_destino):
    tasas_de_cambio = {
        'USD': {'EUR': 0.84, 'GBP': 0.73, 'DOP': 56.80, 'JPY': 110.32},
        'EUR': {'USD': 1.19, 'GBP': 0.87, 'DOP': 67.33, 'JPY': 129.89},
        'GBP': {'USD': 1.38, 'EUR': 1.15, 'DOP': 77.85, 'JPY': 150.19},
        'DOP': {'USD': 0.018, 'EUR': 0.015, 'GBP': 0.013, 'JPY': 1.93},
        'JPY': {'USD': 0.0091, 'EUR': 0.0077, 'GBP': 0.0067, 'DOP': 0.52}
    }

    if divisa_origen == divisa_destino:
        return monto  # No es necesario convertir si es la misma divisa

    if divisa_origen not in tasas_de_cambio or divisa_destino not in tasas_de_cambio[divisa_origen]:
        return None  # No se puede realizar la conversión

    tasa = tasas_de_cambio[divisa_origen][divisa_destino]
    monto_convertido = monto * tasa
    return monto_convertido

def mostrar_menu_divisas():
    print("Seleccione la divisa:")
    print("1. USD - Dólar estadounidense")
    print("2. EUR - Euro")
    print("3. GBP - Libra esterlina")
    print("4. DOP - Peso Dominicano")
    print("5. JPY - Yen Japonés")

monto = float(input("Ingrese la cantidad a convertir: "))

print("Divisa de origen:")
mostrar_menu_divisas()
opcion_origen = int(input("Ingrese el número de la divisa de origen: "))
divisas = ['USD', 'EUR', 'GBP', 'DOP', 'JPY']
divisa_origen = divisas[opcion_origen - 1]

print("\nDivisa de destino:")
mostrar_menu_divisas()
opcion_destino = int(input("Ingrese el número de la divisa de destino: "))
divisa_destino = divisas[opcion_destino - 1]

resultado = convertir_divisa(monto, divisa_origen, divisa_destino)

if resultado is not None:
    print(f"\n{monto} {divisa_origen} equivale a {resultado} {divisa_destino}")
else:
    print("No se puede realizar la conversión. Verifique las divisas ingresadas.")
