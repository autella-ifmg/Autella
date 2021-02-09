package com.example.autella;

import android.os.Bundle;
import android.widget.ListView;
import android.content.Intent;


import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import java.util.ArrayList;

public class VisualizarProvas extends AppCompatActivity {
    private ListView listaProvas;
    private ArrayList<String> nomes;
    private ItemListaProvas adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_visualizar_provas);
        listaProvas = (ListView) findViewById(R.id.listaProvas);

        Intent intencao = getIntent();
        carregaEventosLista();
    }

    private void carregaEventosLista(){
        nomes = new ArrayList<>();
        nomes.add("Provawrd 1");
        nomes.add("provffaw 2");
        nomes.add("proaawfvsdas 3");
        nomes.add("awoindawndáw prvoa 4");

        adapter = new ItemListaProvas(getApplicationContext(), nomes);
        listaProvas.setAdapter(adapter);
    }
}
