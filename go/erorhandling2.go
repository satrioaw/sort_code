//eror handling di dalam bahasa go

package main
import "fmt"


func Sum(a int, b int) int {
    c := a+b
    if c==0 {
      panic("Hasil adalah Nhol")
    }
    return c
}

func main(){
  defer func ()  {
    //apaan nih panic
    if r := recover(); r != nil {
      fmt.Println(r)
    }
  }()

  sum  := Sum(0,0)

  fmt.Println(sum)
}
