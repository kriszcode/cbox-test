package shapes

import "math"

// Shape egy síkidom.
type Shape interface {
	// Area a síkidom területe.
	Area() float64
	Name() string
}

type Circle struct {
	Radius float64
}

func (c Circle) Area() float64 { return math.Pi * c.Radius * c.Radius }
func (c Circle) Name() string   { return "kör" }

type Rectangle struct {
	Width, Height float64
}

func (r Rectangle) Area() float64 { return r.Width * r.Height }
func (r Rectangle) Name() string   { return "téglalap" }
