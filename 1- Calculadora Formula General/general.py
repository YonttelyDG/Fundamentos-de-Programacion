import math

def calcular_formula_general(a, b, c):
    discriminante = b**2 - 4*a*c

    if discriminante < 0:
        return "La ecuación no tiene soluciones reales."
    elif discriminante == 0:
        x = -b / (2*a)
        return f"La solución única es x = {x}"
    else:
        x1 = (-b + math.sqrt(discriminante)) / (2*a)
        x2 = (-b - math.sqrt(discriminante)) / (2*a)
        return f"Las soluciones son x1 = {x1} y x2 = {x2}"

a = float(input("Ingrese el valor de a: "))
b = float(input("Ingrese el valor de b: "))
c = float(input("Ingrese el valor de c: "))

soluciones = calcular_formula_general(a, b, c)
print(soluciones)
