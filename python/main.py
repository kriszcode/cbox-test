from shapes import Circle, Rectangle, Shape


def total_area(shapes: list[Shape]) -> float:
    return sum(s.area() for s in shapes)


def report(shapes: list[Shape]) -> None:
    for shape in shapes:
        print(f"{shape.name():<10} {shape.area():8.2f}")
    print(f"{'összesen':<10} {total_area(shapes):8.2f}")


if __name__ == "__main__":
    report([Circle(1.5), Rectangle(2, 3)])