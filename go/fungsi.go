package main
import "fmt"

func run(a int, b int) (int, int){
    return a + b, a*b

}

func main(){
  sum, multiplication := run(1,2)
  fmt.Println(sum)
  fmt.Println(multiplication)


}
