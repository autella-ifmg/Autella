package com.example.autella;

public class Prova {
    String nome;
    int id;
    String dataDeLiberacao;

    public Prova(String nome, int id, String dataDeLiberacao) {
        this.nome = nome;
        this.id = id;
        this.dataDeLiberacao = dataDeLiberacao;
    }

    public String getNome() { return nome; }

    public int getId() { return id; }

    public String getDataDeLiberacao() { return dataDeLiberacao; }
}