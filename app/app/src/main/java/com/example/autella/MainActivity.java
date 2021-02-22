package com.example.autella;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {

    private Button botaoVisualizarGabaritos;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        botaoVisualizarGabaritos = (Button) findViewById(R.id.botaoVisualizarGabaritos);

        cadastrarEventos();
    }

    private void cadastrarEventos() {
        botaoVisualizarGabaritos.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent troca = new Intent(MainActivity.this, VisualizarProvas.class);
                
                startActivityForResult(troca, 0);
            }
        });
    }
}