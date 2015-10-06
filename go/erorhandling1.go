//eror handling di dalam bahasa go

package main
import "fmt"
import "errors"

func Sum(a int, b int) (int, error){
    c := a+b
    if c== 0{
      return c, errors.New("Hasil adalah O")
    }
    return c, nil
}

func main(){
  sum, error  := Sum(0,0)
  if error != nil{
  fmt.Println("error MSG :", error)
}

  fmt.Println("Sum:",sum)
}
