package main
import "fmt"

var x int = 10

func coba(a int) int{
    return a + x
}

func cobacoba(a int)int {
  x := 20
  return a +x

}

func cobacobacoba(a int) int{
  x =30
  return a+x

}

func main(){
  fmt.Println(coba(11))

  fmt.Println(cobacoba(11))
  fmt.Println(x)

  fmt.Println(cobacobacoba(11))
  fmt.Println(x)

}
