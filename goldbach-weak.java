public class GoldbachWeak {
    public static void main(String[] args) {
        int n = Integer.parseInt(args[0]);
    
        if(n%2!=0){
            System.out.println("Are you trying to fool me with an even number?... <Phlegmatic tone>")
            return 0;
        }

        if(n<7){
            System.out.println("Maybe try something greater than 7... <Passive aggressive tone>")
        }

        // Initially assume all integers are prime
        boolean[] isPrime = new boolean[n+1];
        for (int i = 2; i <= n; i++) {
            isPrime[i] = true;
        }

        // Mark non-primes <= n using Sieve of Eratosthenes
        for (int factor = 2; factor*factor <= n; factor++) {

            // if factor is prime, then mark multiples of factor as nonprime
            // suffices to consider mutiples factor, factor+1, ...,  n/factor
            if (isPrime[factor]) {
                for (int j = factor; factor*j <= n; j++) {
                    isPrime[factor*j] = false;
                }
            }
        }

        // Now use the prime list to create arrangements for sum
        int noArrangements=0;
        for(int i = n-1; i>2; i--){
            if(isPrime[i]){
                for(int j=2; j<n; j++){
                    if (isPrime[j]){
                        for(int k=2;k<n;k++){
                            if(isPrime[k]){
                                if(i+j+k==n){
                                    noArrangements++;
                                    System.out.println("Arrangement[" + noArrangements + "]: " + i + " " + j + " " + k);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}