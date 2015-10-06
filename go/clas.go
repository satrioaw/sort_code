package main
import "fmt"

type King struct {
 data int
}

func (a King) Add(x int) int{

  return x+5
}

func (a King) Result(x int) int {
  return a.data +x

}

func main(){
var w King
fmt.Println(w.Add(3))

fmt.Printf("\n")

var y King  = King{7}
fmt.Println(y.Result(3))
}
