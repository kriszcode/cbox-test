package main

import (
	"fmt"

	"example.com/lsptest/shapes"
)

func totalArea(list []shapes.Shape) float64 {
	sum := 0.0
	for _, s := range list {
		sum += s.Area()
	}
	return sum
}

func report(list []shapes.Shape) {
	for _, s := range list {
		fmt.Printf("%-10s %8.2f\n", s.Name(), s.Area())
	}
	fmt.Printf("%-10s %8.2f\n", "összesen", totalArea(list))
}

func main() {
	report([]shapes.Shape{shapes.Circle{Radius: 1.5}, shapes.Rectangle{Width: 2, Height: 3}})}
