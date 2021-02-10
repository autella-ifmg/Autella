package com.example.autella;

import android.os.Bundle;
import android.os.PersistableBundle;
import android.widget.ListView;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

public class VisualizarGabarito extends AppCompatActivity {
    private ListView listaGabarito;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_visualizar_gabarito);
        listaGabarito = (ListView) findViewById(R.id.listaGabarito);
    }
}
