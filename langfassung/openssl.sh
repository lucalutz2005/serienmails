echo | openssl s_client -connect papier.lucalutz.org.:https 2>/dev/null | openssl x509 -noout -text
