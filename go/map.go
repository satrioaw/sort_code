package main
import "fmt"

func main(){
  variable := make(map[string]int)
  variable["a"] = 1
  variable["b"] = 2
  variable["c"] = 3
  fmt.Printf("%v", variable)
  fmt.Println("\n")
   variable2 := map[string]int{"a":2, "b":4, "c":4}
   fmt.Printf("%v", variable2)

   var conversion float64 = 1.2
   var hasilconv int = int(conversion)

   fmt.Println("\n")
   fmt.Printf("ini adalah hasil koversi dari float ke integer %v",hasilconv)
}
